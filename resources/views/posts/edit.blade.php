@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__('update post')}}</div>

                <div class="card-body">
                    <form action="{{ route('admin.posts.update', $post->id) }}" id="create-item" method="post" novalidate>
                    @method('patch')
                    @csrf
                    @include('posts.form')
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">{{__('update')}}</button>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-default">{{__('cancel')}}</a>
                            </div>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
