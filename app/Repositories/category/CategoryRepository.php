<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends RepositoryAbstract implements CategoryRepositoryInterface
{
    public function __construct()
    {
        parent::__construct();

        $this->modelName = 'Category';
        $this->model = new Category;
        $this->table = 'categories';
    }

     /**
     * Get all.
     *
     * @return Collection
     */
    public function all()
    {
        $categories = $this->model->with('posts')->orderBy('updated_at', 'DESC')->get();

        return $categories;

    }

    /**
     * Store.
     *
     * @param array $data
     *
     * @return
     */
    public function store($data)
    {
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
    public function show($id)
    {
        $category = $this->model->findOrFail($id);

        return $category;
    }

    /**
     * Find.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        $category = $this->model->findOrFail($id);

        return $category;
    }
}
