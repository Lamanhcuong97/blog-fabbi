@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('home') }}">{{ __('messages.ListPost') }}</a>
                    <span>{{ __('messages.ListCagetory') }}</span>
                </div>
                <div class="card-body">
                   <table class="table">
                       <thead>
                            <tr>
                               <th>No</th>
                               <th>name</th>
                               <th>text</th>
                               <th>Created_at</th>
                               <th>Updated_at</th>
                           </tr>
                       </thead>
                       <tbody>
                            @php  
                                $i = 1;
                            @endphp
                            @foreach($categories as $category)
                                <tr>
                                    <td scope="row">{{ $category->id }}</td>
                                    <td><a href="{{route('admin.categories.show', $category->id)}}" >{{ $category->name ?? ''}}</a></td>
                                    <td>{{ $category->text ?? ''}}</td>
                                    <td>{{ $category->created_at ?? ''}}</td>
                                    <td>{{ $category->updated_at ?? ''}}</td>
                                </tr>
                           @endforeach
                           
                       </tbody>
                       
                   </table>
                   {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
