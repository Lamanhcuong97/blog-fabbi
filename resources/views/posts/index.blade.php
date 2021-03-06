@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.ListPost') }}</div>
                <a href="{{route('admin.posts.create')}}" class="btn btn-success" style="width:100px; margin: 10px;">{{ __('create') }}</a>
                <div class="card-body">
                <table class="table" id="table-posts" data-url="{{ route('admin.posts.list') }}">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Title</th>
                               <th>Content</th>
                               <th>Author</th>
                               <th>Categories</th>
                               <th>Image</th>
                               <th>Created_at</th>
                               <th>Updated_at</th>
                               <th></th>
                           </tr>
                       </thead>
                       <tbody>
                           
                       </tbody>
                       
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Post-->
<div id="modalEditPost" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Post</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
            <div class="modal-body">
                <form action="" method="post" id="form-quick-update" enctype="multipart/form-data" name="myForm">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="">
                        @if ($errors->has('title'))
                                <div class="row">
                                <div class="col-lg-8 col-md-10">
                                    <span class="invalid-feedback"  role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            </div>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="title">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="">
                        @if ($errors->has('title'))
                                <div class="row">
                                <div class="col-lg-8 col-md-10">
                                    <span class="invalid-feedback"  role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            </div>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" rows="3" id="content" name="content" placeholder="Enter content"></textarea>
                        @if ($errors->has('content'))
                                <div class="row">
                                <div class="col-lg-8 col-md-10">
                                    <span class="invalid-feedback"  role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                </div>
                                </div>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="content">Categories</label>
                        <select class="form-control" multiple data-live-search="true" id="categories" name="categories[]">
                            <option></option>
                        </select>
                        @if ($errors->has('categories'))
                                <div class="row">
                                <div class="col-lg-8 col-md-10">
                                    <span class="invalid-feedback"  role="alert">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </span>
                                </div>
                                </div>
                            @endif
                    </div>
                    <div class="form-group" >
                        <input type="file" class="form-control " id="image" name="image" placeholder="Enter image" value="">
                        <img src="" id="previewImage" >
                        @if ($errors->has('title'))
                                <div class="row">
                                <div class="col-lg-8 col-md-10">
                                    <span class="invalid-feedback"  role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            </div>
                            </div>
                        @endif
                    </div>
                </form>   
                <div id="upload-imge"> <button class="btn btn-info" id="btn-image" data-url-update="">Image +</button></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-quick-update" data-url-update="" >Update</button>
            
            </div>
       
      </div>
  
    </div>
  </div>
@endsection


