@extends('layouts.master')
@section('content')
    <div class="auth row">

        @if(! Auth::check())
        <div class="col-md-12">
            <form action="/login" method="post">
                {{ csrf_field()  }}
                <h3>Sign in</h3>
                <div class="form-group">
                    <label for="name">Your name:</label>
                    <input type="text" id="name" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="password">Your password:</label>
                    <input type="password" id="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
            @include('layouts.errors')
        </div>
        @else
        <div class="col-md-12">
            <p class="welcome-message">Hello, {{ Auth::user()->name  }}</p>
            <p><a href="/logout" class="badge badge-primary">logout</a></p>
        </div>
        @endif
    </div>
    <table class="table">
        <tr>
            <th>title</th>
            <th>description</th>
            <th>author</th>
            <th>created</th>
            <th colspan="2" class="text-center">action</th>
        </tr>
        @foreach($ads as $ad)

        <tr>
            <td><a href="/ads/{{ $ad->id }}">{{ $ad->title  }}</a></td>
            <td>{{ $ad->description  }}</td>
            <td>{{ $ad->user->name  }}</td>
            <td>{{ $ad->created_at->diffForHumans()  }}</td>
            <td class="text-center">
                @if(auth()->id() == $ad->user->id)
                <form action="/ads/{{ $ad->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
                @else -
                @endif
            <td class="text-center">
                @if(auth()->id() == $ad->user->id)
                <form action="/ads/{{ $ad->id }}/edit" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                </form>
                @else -
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    <p>{{ $ads->render() }}</p>
    @if($flash = session('message'))
        <div class="alert alert-success alert-msg" role="alert">{{ $flash }}</div>
    @endif
    @if(Auth::check())
        <a href="/ads/create">
            <button class="btn btn-primary">Create Add</button>
        </a>
    @endif

@endsection
