<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title', $post->title ?? '')}}">
    @if ($errors->has('title'))
            <div class="row">
            <div class="col-lg-8 col-md-10">
                <span class="invalid-feedback" style="margin: 0px; display: block;" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
            </span>
        </div>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="title">Description</label>
    <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="{{old('description', $post->description ?? '')}}">
    @if ($errors->has('title'))
            <div class="row">
            <div class="col-lg-8 col-md-10">
                <span class="invalid-feedback" style="margin: 0px; display: block;" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
            </span>
        </div>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" rows="3" id="content" name="content" placeholder="Enter content">{{old('content', $post->content ?? '')}}</textarea>
    @if ($errors->has('content'))
            <div class="row">
            <div class="col-lg-8 col-md-10">
                <span class="invalid-feedback" style="margin: 0px; display: block;" role="alert">
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
        @if(!is_null($categories))
            @foreach($categories as $category)
                <option value="{{$category->id}}" 
                    <?php 
                        if (in_array($category->id, isset($post) ? $post->categories->pluck('id')->toArray() : (old('categories') ? old('categories') : []) )) {
                            echo 'selected';
                        }
                    ?>
                 >{{$category->name}}</option>
            @endforeach
        @endif
    </select>
    @if ($errors->has('categories'))
            <div class="row">
            <div class="col-lg-8 col-md-10">
                <span class="invalid-feedback" style="margin: 0px; display: block;" role="alert">
                    <strong>{{ $errors->first('categories') }}</strong>
                </span>
            </div>
            </div>
        @endif
</div>
<div class="form-group">
    <label for="title">Image</label>
    <input type="file" class="form-control" id="image" name="image" placeholder="Enter image" value="{{old('description', $post->description ?? '')}}">
    <img src="{{asset('storage/' .$post->thumnail ?? 'images/noImage.png')}}" id="previewImage" style="width:130px ">
    @if ($errors->has('title'))
            <div class="row">
            <div class="col-lg-8 col-md-10">
                <span class="invalid-feedback" style="margin: 0px; display: block;" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
            </span>
        </div>
        </div>
    @endif
</div>


