<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;

class HomeController extends Controller
{
    protected $PostRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $PostRepository)
    {
        $this->PostRepository = $PostRepository;
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
}
