<?php


namespace App\Service;


use App\Blog;
use Carbon\Carbon;

class BlogService
{
    use ServiceTrait;
    /**
     * @var Blog
     */
    private $model;

    /**
     * BlogService constructor.
     * @param Blog $model
     */
    public function __construct(Blog $model)
    {
        $this->model = $model;
    }


    public function getAllActive()
    {
        return $this->model->select('created_at')->where('status', true)->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('Y-m');
            });
    }


}
