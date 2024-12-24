<div class="widget custom-widget-background p-4 bg-white rounded-lg shadow-md">
    <div class="dimmer">
        <h4 class="text-lg font-semibold">Bookings List</h4>

        @php
            $bookingsCount = \App\Models\Booking::count(); // Подсчет количества бронирований
        @endphp

        <p class="text-gray-600">Total Bookings: {{ $bookingsCount }}</p>

        <div class="text-center mt-4">
            <a href="{{ route('voyager.bookings.index') }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                View All Bookings
            </a>
        </div>
    </div>
</div>
