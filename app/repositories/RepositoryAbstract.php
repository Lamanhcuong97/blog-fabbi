<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class RepositoryAbstract
{
/**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var string Model name
     */
    protected $modelName;

    /**
     * @var string Table name
     */
    protected $table;
    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {

    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function index()
    {
        $result = $this->model->paginate(10);

        return $result;
    }
    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, $data)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
