@extends('layouts/app')
@section('content')
    <div class="container mt-3">
        <table class="table">
            <tr>
                <th> ID </th>
                <th> Title </th>
                <th> Description </th>
            </tr>
            <tr>
                <td>{{$post["id"]}}</td>
                <td>{{$post["title"]}}</td>
                <td>{{$post["description"]}}</td>
            </tr>
        </table>
    </div>

@endsection