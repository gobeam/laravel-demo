<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequestValidation;
use App\Service\CategoryService;
use App\Service\MessageService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $service;
    private $view;
    private $redirectUrl;
    private $title;

    /**
     * CategoryController constructor.
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->title = "Category";
        $this->view = "backend.category.";
        $this->redirectUrl = "/category";
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $emptyCategory = new Category();
        if(!Gate::allows('viewAny', $emptyCategory)) {
            return abort(403);
        }
        $title = $this->title;
        $categories = $this->service->getAll(['title'], $request->keywords)->orderBy('created_at','desc')->paginate(10);
        return view($this->view . "index", compact('categories', 'title', 'emptyCategory'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $title = "Add " . $this->title;
        return view($this->view . "create", compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CategoryRequestValidation $request)
    {
        $data = [];
        try {
            DB::beginTransaction();
            $data['status'] = $request->status ? $request->status : false;
            $data['title'] = $request->title;
            $this->service->store($data);
            DB::commit();
            return redirect($this->redirectUrl)->withErrors(['alert-success' => MessageService::SUCCESS]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => MessageService::ADD_FAIL]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        $title = $category->title;
        return view($this->view . "show", compact('title', 'category'));
    }

    /**
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Category $category)
    {
        $title = "Edit " . $this->title;
        return view($this->view . "edit", compact('category', 'title'));
    }

    /**
     * @param CategoryRequestValidation $request
     * @param Category $category
     * @return RedirectResponse|Redirector
     */
    public function update(CategoryRequestValidation $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $category->update($request->all());
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
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            $category->delete();
            DB::commit();
            return redirect($this->redirectUrl)->withErrors(['alert-success' => MessageService::DELETE]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect($this->redirectUrl)->withErrors(['alert-danger' => MessageService::DELETE_FAIL]);
        }
    }
}
