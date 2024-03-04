@extends('layouts.app')

@section('title', 'Task 1')

@section('content')
    <h1>Posts for User 8</h1>
    <table class="table">
        <tr>
            <th>Title</th>
            <th>Body</th>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['body'] }}</td>
            </tr>
        @endforeach
    </table>
@endsection
