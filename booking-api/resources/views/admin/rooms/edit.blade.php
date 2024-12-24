<x-app-layout>
    @if (Auth::user()->role_id === 1)
        <x-admin.nav />
    @else
        <x-admin.nav :hotel="$hotel" />
    @endif
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded shadow-md flex card text-grey-darkest">
                <div class="w-full flex flex-col justify-between p-4">
                    <h6 class="pt-2">
                        Редактирование номера отеля {{ $room->hotel->title }}
                    </h6>
                    <div class="pt-2">
                        @if($room->facilities->isNotEmpty())
                            <div class="flex items-center py-2">
                                @foreach ($room->facilities as $facility)
                                    <div class="pr-2 text-xs">
                                        <span>•</span> {{ $facility->title }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="pt-2">
                    @if (Auth::user()->role_id === 1)
                        <x-admin.rooms.form-edit :room="$room" :hotel="$hotel" :facilities="$facilities" />
                    @else
                        <x-manager.rooms.form-edit :room="$room" :hotel="$hotel" :facilities="$facilities" />
                    @endif

                    </div>
                </div>
            </div>
            <div class="bg-white rounded shadow-md flex card text-grey-darkest">
                <div class="w-full flex flex-col justify-between p-4">
                        {{ $hotel->id}}
                    <img src="{{ asset('storage/' . $room->poster_url) }}" alt="Hotel Image">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
