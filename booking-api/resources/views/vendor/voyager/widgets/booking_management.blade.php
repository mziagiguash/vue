<div class="widget">
    <h4>Booking Management</h4>
    <ul>
        @foreach($bookings as $booking)
            <li>Booking #{{ $booking->id }} - <a href="{{ route('admin.bookings.show', $booking->id) }}">View</a></li>
        @endforeach
    </ul>
</div>
