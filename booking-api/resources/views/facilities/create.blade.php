@extends('layouts.app')

@section('content')
    <h1>Create Facility</h1>

    <form action="{{ route('facilities.store') }}" method="POST">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" required maxlength="100">
        <button type="submit">Create</button>
    </form>
@endsection
