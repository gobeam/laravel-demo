<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Events\BlogAdded;
use App\Events\NotifySubscriber;
use App\Http\Requests\BlogRequestValidation;
use App\Service\BlogService;
use App\Service\CategoryService;
use App\Service\MessageService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * @var BlogService
     */
    private $service;
    private $view;
    private $redirectUrl;
    private $title;
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * BlogController constructor.
     * @param BlogService $service
     * @param CategoryService $categoryService
     */
    public function __construct(BlogService $service, CategoryService $categoryService)
    {
        $this->title = "Blog";
        $this->view = "backend.blog.";
        $this->redirectUrl = "/blog";
        $this->service = $service;
        $this->categoryService = $categoryService;

    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $title = $this->title;
        $emptyBlog = new Blog();
        $blogs = $this->service->getAll(['title', 'body', 'description', 'user.name'], $request->keywords);
        $user = Auth::user();
        if ($user->role != "admin") {
            $blogs = $blogs->where('user_id', $user->id);
        }
        $blogs = $blogs->orderBy('created_at','desc')->paginate(10);
        return view($this->view . "index", compact('blogs', 'title', 'emptyBlog'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $title = "Add " . $this->title;
        $category = $this->categoryService->getActiveCategoryArray("status", "=", true);
        return view($this->view . "create", compact('title', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(BlogRequestValidation $request)
    {
        $data = [];
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $name = $this->saveImage($request->file('image'));
                $data['image'] = $name;
            }
            $data['user_id'] = Auth::user()->id;
            $data['status'] = $request->status ? $request->status : false;
            $data['title'] = $request->title;
            $data['category_id'] = $request->category_id;
            $data['body'] = $request->body;
            $data['description'] = $request->description;
            $blog = $this->service->store($data);

            // notify all subscribed user through email
            event(new NotifySubscriber($blog, Auth::user()));
            $eventData["message"] = "New blog with title '" . $data['title'] . "' has been added by " . Auth::user()->name . ".";
            $eventData["url"] = "/blog/" . $blog->id . "/view";

            // send push notification
            event(new BlogAdded($eventData));
            DB::commit();
            return redirect($this->redirectUrl)->withErrors(['alert-success' => MessageService::SUCCESS]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => MessageService::ADD_FAIL]);
        }
    }

    /**
     * @param $image
     * @return string
     */
    private function saveImage($image)
    {
        $extension = $image->getClientOriginalExtension();
        $name = time() . Str::random(5) . '.' . $extension;
        Storage::disk('public')->put("blog/" . $name, File::get($image));
        return $name;
    }

    /**
     * Display the specified resource.
     *
     * @param Blog $blog
     * @return Response
     */
    public function show(Blog $blog)
    {
        $title = $blog->title;
        $category = $this->categoryService->getActiveCategoryArray("status", "=", true);
        return view($this->view . "show", compact('title', 'blog', 'category'));
    }

    /**
     * @param Blog $blog
     * @return Factory|View
     */
    public function edit(Blog $blog)
    {
        $title = "Edit " . $this->title;
        $category = $this->categoryService->getActiveCategoryArray("status", "=", true);
        return view($this->view . "edit", compact('blog', 'title', 'category'));
    }

    /**
     * @param BlogRequestValidation $request
     * @param Blog $blog
     * @return RedirectResponse|Redirector
     */
    public function update(BlogRequestValidation $request, Blog $blog)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete("blog/" . $blog->image);
                $name = $this->saveImage($request->file('image'));
                $blog->image = $name;
            }
            $blog->update($request->except('image'));
            DB::commit();
            return redirect($this->redirectUrl)->withErrors(['alert-success' => MessageService::UPDATE]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => MessageService::UPDATE_FAIL]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     * @return Response
     */
    public function destroy(Blog $blog)
    {
        try {
            DB::beginTransaction();
            Storage::disk('public')->delete("blog/" . $blog->image);
            $blog->delete();
            DB::commit();
            return redirect($this->redirectUrl)->withErrors(['alert-success' => MessageService::DELETE]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => MessageService::DELETE_FAIL]);
        }
    }
}
