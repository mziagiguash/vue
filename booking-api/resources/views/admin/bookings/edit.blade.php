<x-app-layout>
    @if (Auth::user()->role_id === 1)
        <x-admin.nav/>
    @else
        <x-admin.nav :hotel="$hotel"/>
    @endif
    <x-admin.bookings.form-edit :booking="$booking" :statuses="$statuses"></x-admin.bookings.form-edit>
</x-app-layout>
