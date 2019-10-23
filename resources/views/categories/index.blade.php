@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.ListCagetory') }}</div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-success" style="width:100px; margin: 10px;">{{ __('create') }}</a>
                <div class="card-body">
                   <table class="table">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>name</th>
                               <th>text</th>
                               <th>Created_at</th>
                               <th>Updated_at</th>
                               <th></th>
                           </tr>
                       </thead>
                       <tbody>
                            @php  
                                $i = 1;
                            @endphp
                            @foreach($categories as $key => $category)
                                <tr id="tr_{{ $category->id }}">
                                    <td scope="row">{{ $category->id }}</td>
                                    <td><a href="{{ route('admin.categories.show', $category->id) }}" class="name">{{ $category->name ?? ''}}</a></td>
                                    <td class="text">{{ $category->text ?? ''}}</td>
                                    <td class="created_at">{{ $category->created_at ?? ''}}</td>
                                    <td class="updated_at">{{ $category->updated_at ?? ''}}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-info">{{ __('edit') }}</a>
                                        <button type="button" data-url="{{ route('admin.categories.find', $category->id) }}" 
                                            data-url-update="{{ route('admin.categories.updateAjax', $category->id) }}"
                                            class="btn btn-primary quick-edit"  data-toggle="modal" data-target="#exampleModal">
                                            Quick Edit
                                        </button>
                                        <form action="{{route('admin.categories.destroy', $category->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button class="btn btn-danger">{{ __('delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                           @endforeach
                       </tbody>
                       
                   </table>
                   {{ $categories->links() }}
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Cagetory</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" id="form-quick-update" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label for="">name</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" name="id" value="" hidden>
                                            <input type="text" class="form-control " id="name" name="name" placeholder="" value="">
                                            @if($errors->has('name'))
                                            <span class="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label for="">text</label>
                                        </div>
                                        <div class="col-8">
                                            <textarea type="text" class="form-control" id="text" name="text" placeholder=""></textarea>
                                            @if($errors->has('text'))
                                            <span class="alert">
                                                <strong>{{ $errors->first('text') }}</strong>
                                            </span>
                                            @endif
                                        </div>                                       
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" data-id="" class="btn btn-primary" id="update-ajax">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
