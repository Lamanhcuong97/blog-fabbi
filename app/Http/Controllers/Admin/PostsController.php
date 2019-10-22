<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    protected $PostRepository, $CategoryRepository;

    /**
     * Contructor
     *
     * @param PostRepositoryInterface $repository
     */
    public function __construct(PostRepositoryInterface $PostRepository, CategoryRepositoryInterface $CategoryRepository){
        $this->PostRepository = $PostRepository;
        $this->CategoryRepository = $CategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->PostRepository->index();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->CategoryRepository->all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->validate($request, ['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072']);
        $data = $request->all();
        if(isset($data['image'])){
            $path = "images";
            $name = 'image';
            $data['thumnail'] = $this->PostRepository->storeFile($name, $path) ?? '';
        }
        $post = $this->PostRepository->store($data);

        return redirect(route('admin.posts.index'))->with('success', 'Create post successful');
    }

    /**s
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->PostRepository->find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->PostRepository->find($id);
        $categories = $this->CategoryRepository->all();
        
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $this->validate($request, ['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072']);
        $data = $request->all();
        if(isset($data['image'])){
            $path = "images";
            $name = 'image';
            $data['thumnail'] = $this->PostRepository->storeFile($name, $path) ?? '';
        }
        $post =$this->PostRepository->update( $id, $data);

        return redirect(route('admin.posts.index'))->with('success', 'Edit post successful');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->PostRepository->destroy($id);

        return redirect(route('admin.posts.index'))->with('success', 'Delete post successful');
    }
}
