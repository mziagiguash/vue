<x-app-layout>
    @if (Auth::user()->role_id === 1)
        <x-admin.nav />
    @else
        <x-admin.nav :hotel="$hotel"/>
    @endif
        <x-admin.hotels.form :facilities="$facilities" />
    @if($hotels->isNotEmpty())
        <x-admin.hotels.list :hotels="$hotels" />
    @endif
</x-app-layout>
