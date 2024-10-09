@extends('components.layout')

@section('content')
    <h1 class="text-center">Posts Page</h1>
    <div>
        <div class="card mt-5">

            <div class="card-body text-center">
                <div class="card-title d-flex justify-content-between">
                    <h3>Trashed Posts</h3>
                    <div>
                        <a href="{{route('posts.index')}}" class="btn btn-primary">Back</a>

                    </div>
                </div>
                <div class="card-text ">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td ><img src="{{asset($post->image)}}" alt="" width="50px" ></td>
                                <td><h5>{{$post->title}}</h5></td>
                                <td ><p>{{$post->description}}</p></td>
                                <td>{{$post->category->name}}</td>
                                <td>12-12-2023</td>
                                <td >
                                    <div class="d-flex  justify-content-center align-items-center">

                                        <a href="{{route('posts.restore', $post->id)}}" class="btn btn-warning btn-sm mr-2">Restore</a>
                                        <div>
                                            <form action="{{route('posts.force-delete', $post->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
