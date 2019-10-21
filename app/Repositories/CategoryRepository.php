<?php

namespace App\Repositories;
use App\Repositories\RepositoryInterface;
use App\Models\Category;

class CategoryRepository implements RepositoryInterface{
    protected $model;
    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Category();
    }

     /**
     * Find.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id){
        $category = $this->model->with('posts')->findOrFail($id);

        return $category;
    }

    /**
     * Get all.
     *
     * @return Collection
     */
    public function all(){
        $categories = $this->model->with('posts')->orderBy('updated_at', 'DESC')->get();

        return $categories;

    }

    /**
     * Index.
     *
     * @param array $datas
     *
     * @return Collection|Paginator
     */
    public function index($data = []){
        $categories = $this->model->with('posts')->orderBy('updated_at', 'DESC')->paginate(10);
        

        return $categories;
    }

    /**
     * Store.
     *
     * @param array $data
     *
     * @return
     */
    public function store($data){
        $category = $this->model->insert($data);

        return $category;
    }

    /**
     * Show.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function show($id){
        $category = $this->model->findOrFail($id);

        return $category;
    }

    /**
     * Update.
     *
     * @param int $id
     * @param array $data
     *
     * @return Model
     */
    public function update($id, $data){
        $category = $this->model->findOrFail($id);
        $category = $categor->update($data);

        return $category;
    }

    /**
     * Delete.
     *
     * @param Collection|array|int $id
     *
     * @return int
     */
    public function destroy($id){
        $this->model->destroy($id);

        return true;
    }
}
