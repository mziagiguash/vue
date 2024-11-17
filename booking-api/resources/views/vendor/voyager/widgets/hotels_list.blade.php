<div class="widget">
    <h4>Hotel List</h4>
    <ul>
        @foreach($hotels as $hotel)
            <li>{{ $hotel->name }} - <a href="{{ route('voyager.hotels.show', $hotel->id) }}">View</a></li>
        @endforeach
    </ul>
</div>
