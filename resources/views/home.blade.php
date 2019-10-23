@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <span>{{ __('messages.ListPost') }}</span>
                    <a href="{{ route('listCategory') }}">{{ __('messages.ListCagetory') }}</a>
                </div>
                <div class="card-body">
                <table class="table" id="table-user-posts" data-url="{{route('posts.list')}}">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Title</th>
                               <th>Content</th>
                               <th>Author</th>
                               <th>Categories</th>
                               <th>Thumnail</th>
                               <th>Created_at</th>
                               <th>Updated_at</th>
                           </tr>
                       </thead>
                       <tbody>
                            {{-- @php  
                                $i = 1;
                            @endphp
                            @foreach( $posts as $post )
                                <tr>
                                    <td scope="row">{{ $post->id }}</td>
                                    <td><a href="{{route('showPost', $post->id)}}" >{{ $post->title ?? ''}}</a></td>
                                    <td>{{ $post->content ?? ''}}</td>
                                    <td>{{ $post->user->name ?? ''}}</td>
                                    <td>{!! $post->categories->pluck('name') !!}</td>
                                    <td>{{ $post->created_at ?? ''}}</td>
                                    <td>{{ $post->updated_at ?? ''}}</td>
                                </tr>
                           @endforeach --}}
                           
                       </tbody>
                       
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
