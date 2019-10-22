<?php

namespace App\Repositories\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Models\Post;
use DB;
use Auth;
use App\Repositories\RepositoryAbstract;

class PostRepository extends RepositoryAbstract implements PostRepositoryInterface{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Post;
        $this->modelName = 'post';
        $this->table = 'posts';
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
            $categories_id = $data['categories'];
            unset($data['categories']);
            unset($data['_token']);
            $data['thumnail'] = 'image/noImage/png';
            $data['user_id'] =  Auth::id();
            $post = $this->model->create($data);
            $post->categories()->attach($categories_id);
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
            $categories_id = $data['categories'];
            unset($data['categories']);
            unset($data['_token']);
            $data['thumnail'] = 'image/noImage/png';
            $data['user_id'] =  Auth::id();
            $post = $this->model->findOrFail($id);
            $post->update($data);
            $post->categories()->sync($categories_id);
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
        Post::deleting(function($post){
            $post->categories()->detach();
        });

        $this->model->destroy($id);

        return true;
    }
}
