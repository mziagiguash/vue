<x-app-layout>
    @if (Auth::user()->role_id === 1)
        <x-admin.nav />
    @else
        <x-admin.nav :hotel="$hotel"/>
    @endif

    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded shadow-md flex card text-grey-darkest">
                <div class="w-full flex flex-col justify-between p-4">
                    <h6>Добавление номера для отеля {{ $hotel->title }}</h6>
                    @if (Auth::user()->role_id === 1)
                        <x-admin.rooms.form :hotel="$hotel" :facilities="$facilities"></x-admin.rooms.form>
                    @else
                        <x-manager.rooms.form :hotel="$hotel" :facilities="$facilities"></x-manager.rooms.form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($hotel->rooms->isNotEmpty())
        <x-admin.rooms.list :rooms="$rooms" :hotel="$hotel"></x-admin.rooms.list>
    @endif
</x-app-layout>
