@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.ListCagetory') }}</div>
                <a href="{{route('admin.categories.create')}}" class="btn btn-success" style="width:100px; margin: 10px;">{{__('create')}}</a>
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
                            @foreach($categories as $category)
                                <tr>
                                    <td scope="row">{{$category->id}}</td>
                                    <td><a href="{{route('admin.categories.show', $category->id)}}" >{{ $category->name ?? ''}}</a></td>
                                    <td>{{ $category->text ?? ''}}</td>
                                    <td>{{ $category->created_at ?? ''}}</td>
                                    <td>{{ $category->updated_at ?? ''}}</td>
                                    <td>
                                        <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-warning">{{__('edit')}}</a>
                                        <form action="{{route('admin.categories.destroy', $category->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button class="btn btn-danger">{{__('delete')}}</button>
                                        </form>
                                    </td>
                                </tr>
                           @endforeach
                           
                       </tbody>
                       
                   </table>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
