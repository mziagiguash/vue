@extends('layouts.admin')

@section('content')
    <h1>Bookings for {{ $user->name }}</h1>

    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        <a href="{{ route('admin.user.bookings.show', [$user->id, $booking->id]) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $bookings->links() }}
@endsection
