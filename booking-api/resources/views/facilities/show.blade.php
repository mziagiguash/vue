@extends('layouts.app')

@section('content')
    <h1>{{ $facility->title }}</h1>

    <h2>Assigned Hotels</h2>
    <ul>
        @foreach($facility->hotels as $hotel)
            <li>{{ $hotel->title }}</li>
        @endforeach
    </ul>

    <h2>Assigned Rooms</h2>
    <ul>
        @foreach($facility->rooms as $room)
            <li>{{ $room->title }}</li>
        @endforeach
    </ul>
@endsection
