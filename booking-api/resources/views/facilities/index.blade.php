@extends('layouts.app')

@section('content')
    <h1>Facilities</h1>
    <a href="{{ route('facilities.create') }}">Add Facility</a>
    <ul>
        @foreach($facilities as $facility)
            <li>{{ $facility->title }}</li>
        @endforeach
    </ul>
@endsection
