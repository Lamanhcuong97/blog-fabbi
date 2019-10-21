<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class CategoryRepository extends RepositoryAbstract 
{
    public function __construct()
    {
        parent::__construct();

        $this->modelName = 'Categories';
        $this->model = new Categories;
        $this->table = 'categories';
    }
}
