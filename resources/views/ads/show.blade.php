@extends('layouts.master')
@section('content')
    <h3 class="text-center">Title of ad: {{ $ad->title }}</h3>
    <p>Description: {{ $ad->description }}</p>
    <p>Created by: {{ $ad->user->name }}</p>
    <p>Created at {{ $ad->created_at }}</p>
    <div class="actions">
        @if(auth()->id() == $ad->user->id)
        <form action="/ads/{{ $ad->id }}/edit" method="post" class="edit-form">
            {{ csrf_field() }}
            <button type="submit" class="btn edit">Edit Ad</button>
        </form>
        <form action="/ads/{{ $ad->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn delete">Delete Ad</button>
        </form>
        @endif
    </div>
    <a href="/">home page</a>
@endsection
