<?php


namespace App\Service;


use Symfony\Component\Routing\Exception\ResourceNotFoundException;

trait ServiceTrait
{

    /**
     * @param $field
     * @param $operator
     * @param $value
     * @return mixed
     */
    public function getByCondition($field, $operator, $value)
    {
        return $this->model->where($field, $operator, $value)->get();
    }

    /**
     * @param $searchFieldArray
     * @param $keywords
     * @return mixed
     */
    function getAll($searchFieldArray, $filter)
    {
        $query = $this->model->query();
        if (isset($filter->keywords)) {
            $query->whereLike($searchFieldArray, $filter->keywords);
        }
        if (isset($filter->year)) {
            $query->whereYear('created_at', '=', $filter->year);
        }
        if (isset($filter->month)) {
            $query->whereMonth('created_at', '=', $filter->month);
        }
        if (isset($filter->category_id)) {
            $query->where('category_id', $filter->category_id);
        }
        return $query;

    }

    /**
     * @param $data
     * @return static
     */
    function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    function update($data)
    {
        $model = $this->model->find($data->id);
        if ($model == null)
            throw new ResourceNotFoundException("Item not found", 404);

        $model->update($data);
        return $model;

    }

    /**
     * @param $id
     * @return mixed
     * @throws ResourceNotFoundException
     */
    function delete($id)
    {
        $model = $this->model->find($id);

        if ($model == null)
            throw new ResourceNotFoundException("Item not found", 404);

        return $model->delete();

    }

    /**
     * @param $id
     * @param $relationshipIds
     * @return mixed
     */
    function updateRelationship($id, $relationshipIds)
    {
        $model = $this->findById($id);
        if ($model != null) {
            $model->categories()->sync($relationshipIds);
        }
        return $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return $this->model->find($id);
    }

}
