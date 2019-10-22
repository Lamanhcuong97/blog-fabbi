<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Storage;

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
     * Delete.
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

        /**
     * Store file.
     *
     * @param string $name
     * @param string $path
     *
     * @return string
     */
    public function storeFile($name, $path)
    {
        if(request()->hasFile($name)) {
            // Get filename with extension
            $filenameWithExt = request()->file($name)->getClientOriginalName();
            
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          
            // Get just ext
            $extension = request()->file($name)->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'_'. rand(1000, 9999) .'.'.$extension;
          
            // Upload Image
            $path = request()->file($name)->storeAs($path, $fileNameToStore);
            

            Storage::url($path);

            return $path;
        }
    }
}
