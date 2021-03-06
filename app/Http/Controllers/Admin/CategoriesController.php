<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\requestCategory;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use DataTables;

class CategoriesController extends Controller
{
    protected $CategoryRepository;
    
    public function __construct(CategoryRepositoryInterface $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->CategoryRepository->index();
        return view("categories.index", compact("categories"));
    }

    public function listCategoryDataTables()
    {
        $categories = $this->CategoryRepository->index();
        
        return DataTables::of($categories)
        ->addColumn('action', function ($row) {
            return "<a href='" . route('admin.categories.edit', $row->id) . "' class='btn btn-info'>" . __('edit') . "</a>
            <button type='button' data-url=" . route('admin.categories.find', $row->id) . " 
                data-url-update=" . route('admin.categories.updateAjax', $row->id) . "
                class='btn btn-primary quick-edit'  data-toggle='modal' data-target='#exampleModal'>
                Quick Edit
            </button>
            <form action=" . route('admin.categories.destroy', $row->id) . " method='post'>
            <input type='hidden' name='_method' value='DELETE'>
            <input type='hidden' name='_token' value='".csrf_token()."'>
            <button class='btn btn-danger'>" . __('delete') . "</button>
            </form>";
        })
        ->make(TRUE);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.create");
    }

    public function find($id)
    {
        $categories = $this->CategoryRepository->find($id);

        return response()->json([ 'categories' => $categories]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(requestCategory $request)
    {
        $data = $request->all();
        $createSucces = $this->CategoryRepository->create($data);
        return redirect()->back()->with('message', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->CategoryRepository->find($id);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->CategoryRepository->find($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(requestCategory $request, $id)
    {
        $data = $request->all();
        $category = $this->CategoryRepository->update($id, $data);

        return redirect(route('admin.categories.index'))->with('message', 'success');
    }

    public function updateAjax(requestCategory $request, $id)
    {
        $data = $request->all();
        $category = $this->CategoryRepository->update($id, $data);

        return response()->json($category);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->CategoryRepository->destroy($id);

        return redirect(route('admin.categories.index'))->with('success', 'Delete category successful');
    }
}
 