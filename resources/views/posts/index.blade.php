@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.ListPost') }}</div>
                <a href="{{route('admin.posts.create')}}" class="btn btn-success" style="width:100px; margin: 10px;">{{__('create')}}</a>
                <div class="card-body">
                   <table class="table">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Title</th>
                               <th>Content</th>
                               <th>Author</th>
                               <th>Categories</th>
                               <th>Created_at</th>
                               <th>Updated_at</th>
                               <th></th>
                           </tr>
                       </thead>
                       <tbody>
                            @php  
                                $i = 1;
                            @endphp
                            @foreach($posts as $post)
                                <tr>
                                    <td scope="row">{{$post->id}}</td>
                                    <td><a href="{{route('admin.posts.show', $post->id)}}" >{{ $post->title ?? ''}}</a></td>
                                    <td>{{ $post->content ?? ''}}</td>
                                    <td>{{ $post->user->name ?? ''}}</td>
                                    <td>{!! $post->categories->pluck('name') !!}</td>
                                    <td>{{ $post->created_at ?? ''}}</td>
                                    <td>{{ $post->updated_at ?? ''}}</td>
                                    <td>
                                        <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning">{{__('edit')}}</a>
                                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button class="btn btn-danger">{{__('delete')}}</button>
                                        </form>
                                    </td>
                                </tr>
                           @endforeach
                           
                       </tbody>
                       
                   </table>
                   {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
