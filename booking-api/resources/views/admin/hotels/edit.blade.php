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
                    <h6>
                        Отель {{ $hotel->title }}
                    </h6>
                    <div>
                        @if($hotel->facilities->isNotEmpty())
                            <div class="flex items-center py-2">
                                @foreach ($hotel->facilities as $facility)
                                    <div class="pr-2 text-xs">
                                        <span>•</span> {{ $facility->title }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="pt-2">
                        @if (Auth::user()->role_id === 1)
                            <x-admin.hotels.form-edit :hotel="$hotel" :facilities="$facilities"></x-admin.hotels.form-edit>
                        @else
                            <x-manager.hotels.form-edit :hotel="$hotel" :facilities="$facilities"></x-manager.hotels.form-edit>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-white rounded shadow-md flex card text-grey-darkest">
                <div class="w-full flex flex-col justify-between p-4">
                    <img src="{{ asset('storage/' . $hotel->poster_url) }}" alt="Hotel Image">
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
