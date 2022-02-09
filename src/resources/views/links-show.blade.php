@extends('layout.master');

@section('content')
    <ul>
    @foreach($links as $link)
            <li>
                <a href="{{route('link.redirect', $link->token)}}">{{$link->token}}</a>
            </li>
    @endforeach
    </ul>
@endsection