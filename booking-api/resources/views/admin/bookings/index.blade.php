<x-app-layout>
    @if (Auth::user()->role_id === 1)
    <x-admin.nav />
    @else
        <x-admin.nav :hotel="$hotel"/>
    @endif
    @if($bookings->isNotEmpty())
        {{-- @if (Auth::user()->role_id === 1) --}}
            <div class="booking-table-admin">
            {{-- <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container xl:mx-auto"> --}}
                <x-admin.bookings.list :bookings="$bookings"></x-admin.bookings.list>
            </div>
        {{-- @else --}}
            {{-- <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container xl:mx-auto"> --}}
                {{-- <x-manager.bookings.list :bookings="$bookings" ></x-manager.bookings.list> --}}
            {{-- </div> --}}
        {{-- @endif --}}
    @else
        <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container xl:mx-auto">
            <h1 class="text-lg md:text-xl font-semibold text-gray-800">Нет бронирований</h1>
        </div>
    @endif

</x-app-layout>
