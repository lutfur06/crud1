@extends('components.layout')

@section('content')
    <h1 class="text-center">Single Post Page</h1>
    <div>
        <div class="card mt-5">

            <div class="card-body text-center">
                <div class="card-title d-flex justify-content-between">
                    <h3>All Posts</h3>
                    <div>
                        <a href="{{route('posts.index')}}" class="btn btn-warning"> Back </a>
                    </div>
                </div>
                <div class="card-text ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
<tr>
    <th>ID</th>
    <td>{{$post->id}}</td>
</tr>
<tr>
    <th>Image</th>
    <td><img src="{{asset($post->image)}}" alt="" width="300px"></td>
</tr>
<tr>
    <th>Title</th>
    <td><h3>{{$post->title}}</h3></td>
</tr>
<tr>
    <th>Description</th>
    <td><p>{{$post->description}}</p></td>
</tr>
<tr>
    <th>Category</th>
    <td>{{$post->category_id}}</td>
</tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
