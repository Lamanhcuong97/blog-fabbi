@extends('layouts.admin')

@section('content')
    <div class="card w-100">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @method("PATCH")
                @csrf
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-4">
                        <label for="">name</label>
                    </div>
                    <div class="col-8">
                    <input type="text" class="form-control " id="name" name="name" placeholder="" value = "{{ $category->name }}">
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
                        <textarea type="text" class="form-control" id="text" name="text" placeholder="">{{ $category->text }}</textarea>
                        @if($errors->has('text'))
                        <span class="alert">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                        @endif
                    </div>
                    
                </div>
                <div style="margin-left:95%">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
@endsection
