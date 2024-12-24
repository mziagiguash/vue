<!-- resources/views/widgets/hotels_widget.blade.php -->

<div class="widget custom-widget-background">
    <div class="dimmer">
        <h4>Hotels List</h4>

        @php
            $hotelsCount = \App\Models\Hotel::count(); // Подсчет количества отелей
        @endphp

        <p>Total Hotels: {{ $hotelsCount }}</p>

        <div class="text-center mt-4">
            <a href="{{ route('voyager.hotels.index') }}" class="btn btn-primary">View All Hotels</a>
        </div>
    </div>
</div>
