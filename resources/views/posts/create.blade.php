@extends('components.layout')

@section('content')
    <div class="col-md-8 offset-md-2 card mt-5">
        <div class="card-body ">
            <h1 class="card-title text-center">Create Post</h1>
            <div class="card-text">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class=" form-control" name="category_id">
                            <option selected>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
