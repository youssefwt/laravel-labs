@extends('layouts/app')
@section('content')
    <div class="container">
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <form action="{{route("posts.store")}}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label  class="form-label">Title</label>
                <input type="text" name="title" class="form-control" >
            </div>
            <div class="mb-3">
                <label  class="form-label">Description</label>
                <input type="text"  name="description" class="form-control" >
            </div>
            <div class="mb-3">
                <input type="file" name="image" >
            </div>
            <div class="mb-3">
                <label class="form-lable">post creator</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="mb-3 text-center">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
@endsection
    