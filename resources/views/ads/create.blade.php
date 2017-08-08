@extends('layouts.master')
@section('content')
    <form action="/ads" method="post">
        {{ csrf_field()  }}
        <h3 class="text-center">Crete Ad</h3>
        <div class="form-group">
            <label for="title">Title of Ad</label>
            <input type="text" id="title" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label for="description">Description of Ad</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Ad</button>
        </div>
        @include('layouts.errors')
    </form>
@endsection
