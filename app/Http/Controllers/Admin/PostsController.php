<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\PostRequest;
use DataTables;

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
    public function index(Request $request)
    {
        return view('posts.index');
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
                        $url= asset('storage/' . $row->thumnail );
                        $img = "<img src='" . $url . "' border='0' width='40' class='img-rounded' align='center' />";

                        return $img;
                })
                ->addColumn('action', function($row){
                       $action = "<a href='" . route('admin.posts.edit', $row->id) . "' class='btn btn-warning'>" . __('edit') . "</a><button class='btn btn-info btn-quick-edit' data-toggle='modal' data-target='#modalEditPost' data-url-update=".route('admin.posts.quickUpdate', $row->id )." data-url=".route('admin.posts.find', $row->id ).">". __("quick edit") ."</button><form action='".route('admin.posts.destroy', $row->id) ."' method='post'> <input type='hidden' name='_token' value='".csrf_token()."'>
                       <input type='hidden' name='_method' value='DELETE'><button class='btn btn-danger'>" . __("delete") . "</button></form>";
                        return $action;
                })
                ->rawColumns(['action', 'thumnail'])
                ->make(true);
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

    /**
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

    /**
     * Find a Post
     *s
     * @param int $ids
     * @return JSON
     */
    public function find($id){
        $post = $this->PostRepository->find($id);
        $post->thumnail = asset( 'storage/' . $post->thumnail);
        $categories = $this->CategoryRepository->all();
        $post->categories = $post->categories->pluck('id')->toArray();
        return response()->json(
            [
                'post' => $post,
                'categories' => $categories,
                'post_categories' => $post->categories
            ]
        );
    }

    /**
     * Quick Update a Post
     *s
     * @param int $idss
     * @return JSON
     */
    public function quickUpdate(Request $request, $id ){
        $this->validate($request, ['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072']);
        $data = $request->all(); 
        
        if(isset($data['image'])){
            $path = "images";
            $name = 'image';
            $data['thumnail'] = $this->PostRepository->storeFile($name, $path) ?? '';
        }

        $post =$this->PostRepository->update( $id, $data);
        if(!$post){
            
            return response()->json(
                [
                    'error' => 'Update failed !!!',
                ]
            );
        }

        $post->thumnail = asset( 'storage/' . $post->thumnail);
        $categories = $this->CategoryRepository->all();
        $post->categories = $post->categories->pluck('name')->toArray();

        return response()->json(
            [
                'post' => $post,
                'categories' => $categories,
                'post_categories' => $post->categories
            ]
        );
    }

}
