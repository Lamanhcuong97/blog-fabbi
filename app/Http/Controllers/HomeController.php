<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use DataTables;

class HomeController extends Controller
{
    protected $PostRepository, $CategoryRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $PostRepository, CategoryRepositoryInterface $CategoryRepository)
    {
        $this->PostRepository = $PostRepository;
        $this->CategoryRepository = $CategoryRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = $this->PostRepository->index();

        return view('home', compact('posts'));
    }

    public function show($id){
        $post = $this->PostRepository->find($id);

        return view('show', compact('post'));
    }

    public function listCategory()
    {
        $categories = $this->CategoryRepository->index();

        return view('listCategory', compact('categories'));

    }

    public function list() {
        $data = $this->PostRepository->index();

        return  Datatables::of($data)
                ->addColumn('author', function($row){

                        return $row->user->name ;
                })
                ->addColumn('categories', function($row){

                        return $row->categories->pluck('name');
                })
                ->addColumn('thumnail', function($row){
                        $url= asset('storage/'.$row->thumnail);
                        $img = "<img src='".$url."' border='0' width='40' class='img-rounded' align='center' />";

                        return $img;
                })
                ->rawColumns(['thumnail'])
                ->make(true);

    }
}
