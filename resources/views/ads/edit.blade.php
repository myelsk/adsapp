@extends('layouts.master')
@section('content')
    <form method="post" action="/ads/{{ $ad->id }}">
        {{ csrf_field()  }}
        {{ method_field('PUT')  }}
        <h3 class="text-center">Update Ad</h3>
        <div class="form-group">
            <label for="title">Edit name of Ad</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $ad->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description of Ad</label>
            <textarea class="form-control" id="description" name="description">{{ $ad->description  }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update ad</button>
        @include('layouts.errors')
    </form>
@endsection
