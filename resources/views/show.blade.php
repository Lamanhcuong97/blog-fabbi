@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.ListPost') }}</div>
                <div class="card-body">
                    <p scope="row">ID: {{ $post->id }}</p>
                    <p>Title: {{ $post->title ?? ''}}</p>
                    <p>Content: {{ $post->content ?? ''}}</p>
                    <p>Author: {{ $post->user->name ?? ''}}</p>
                    <p>Categories: {!! $post->categories->pluck('name') !!}</p>
                    <p>Created At: {{ $post->created_at ?? ''}}</p>
                    <p>Updated At: {{ $post->updated_at ?? ''}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
