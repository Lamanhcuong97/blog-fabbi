<?php

namespace App\Repositories;
use App\Repositories\RepositoryInterface;
use App\Models\Post;

class PostRepository implements RepositoryInterface{
    protected $model;
    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Post;
    }

      /**
     * Find.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id){
        $post = $this->model->findOrFail($id);

        return $post;
    }

    /**
     * Get all.
     *
     * @return Collection
     */
    public function all(){
        $posts = $this->model->with(['user', 'categories'])->orderBy('updated_at', 'DESC')->get();

        return $posts;

    }

    /**
     * Index.
     *
     * @param array $data
     *
     * @return Collection|Paginator
     */
    public function index($data = []){
        $posts = $this->model->with(['user', 'categories'])->orderBy('updated_at', 'DESC')->paginate(10);

        return $posts;
    }

    /**
     * Store.
     *
     * @param array $data
     *
     * @return
     */
    public function store($data){

        DB::beginTransaction();
        try {
            $category_id = $data['category_id'];
            unset($data['category_id']);
            $post = $this->model->insert($data);
            $post->categories()->attach($category_id);
            DB::commit();
                
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());

            return false;
        }
    }

    /**
     * Show.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function show($id){
        $post = $this->model->with(['user', 'categories'])->findOrFail($id);

        return $post;
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
        DB::beginTransaction();
        try {
            $category_id = $data['category_id'];
            unset($data['category_id']);
            $post = $this->model->findOrFail($id);
            $post = $categor->update($data);
            $post->categories()->sync($category_id);
            DB::commit();
                
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());

            return false;
        }
    }

    /**
     * Delete.
     *
     * @param Collection|array|int $id
     *
     * @return int
     */
    public function destroy($id){
        Review::deleting(function($post){
            $post->categories()->detach();
        });

        $this->model->destroy($id);

        return true;
    }
}
