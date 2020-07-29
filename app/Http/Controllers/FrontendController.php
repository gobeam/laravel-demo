<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Service\BlogService;
use App\Service\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
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
        $this->view = "frontend.blog.";
        $this->redirectUrl = "/";
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
        $blogs = $this->service->getAll(['title', 'body', 'description', 'user.name'], $request)->orderBy('created_at','desc')->paginate(10);
        $archives = $this->service->getAllActive()->toArray();
        return view($this->view . "index", compact('blogs', 'title', 'emptyBlog', 'archives'));
    }

    /**
     * @param Blog $blog
     * @return Factory|View
     */
    public function show(Blog $blog)
    {
        $title = $blog->title;
        $archives = $this->service->getAllActive()->toArray();
        return view($this->view . "show", compact('title', 'blog', 'archives'));
    }
}
