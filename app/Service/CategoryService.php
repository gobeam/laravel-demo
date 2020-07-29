<?php


namespace App\Service;


use App\Category;

class CategoryService
{
    use ServiceTrait;
    /**
     * @var Category
     */
    private $model;

    /**
     * CategoryService constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @param $field
     * @param $operator
     * @param $value
     * @return mixed
     */
    public function getActiveCategoryArray($field, $operator, $value)
    {
        return $this->model->where($field, $operator, $value)->pluck('title', 'id');
    }


}
