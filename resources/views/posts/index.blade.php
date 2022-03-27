@extends('layouts/app')
@section('content')
     {{-- @dd($posts); --}}
    <div class="container mt-3">
        {{-- @auth --}}
        <div class="text-center">
            <td><a href="{{ route('posts.create') }}" class="btn btn-success">Add New Post </a></td>
        </div>
        {{-- @endauth --}}
        <table class="table">
            <tr>
                <th> ID </th>
                <th> Title </th>
                <th> Description </th>
                <th> posted by </th>
                <th> View </th>
                <th> Edit </th>
                <th> Delete </th>
                
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post["id"]}}</td>
                    <td>{{$post["title"]}}</td>
                    <td>{{$post["description"]}}</td>
                    <td>{{$post->userRelation->name}}</td>
                    <td><a href="{{ route('posts.show',['post'=>$post["id"]]) }}" class="btn btn-info">View </a></td>
                    @auth
                    @if(Auth::user()->id == $post->user_id)
                    <td><a href="{{ route('posts.edit',['post'=>$post["id"]]) }}" class="btn btn-warning">Edit </a></td>
                    <td> <form action="{{route("posts.destroy",$post["id"])}}"  method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete"  class="btn btn-danger">
                    </form></td>
                    @endif
                    @endauth
                </tr>
            @endforeach
        </table>
        {{ $posts->links() }}
    </div>
    
@endsection