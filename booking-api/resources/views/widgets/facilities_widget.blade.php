<!-- resources/views/widgets/facilities_widget.blade.php -->

<div class="widget custom-widget-background">
    <div class="dimmer">
        <h4>Facilities List</h4>

        @php
            $facilitiesCount = \App\Models\Facility::count(); // Подсчет количества удобств
        @endphp

        <p>Total Facilities: {{ $facilitiesCount }}</p>

        <ul>
            @foreach(\App\Models\Facility::all() as $facility)
                <li>{{ $facility->title }} - {{ $facility->hotels->count() }} hotels using</li>
            @endforeach
        </ul>

        <div class="text-center mt-4">
            <a href="{{ route('voyager.facilities.index') }}" class="btn btn-primary">View All Facilities</a>
        </div>
    </div>
</div>
