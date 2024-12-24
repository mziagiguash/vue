<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-200 1xl:container 2xl:mx-auto">
        <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded shadow-md flex card text-grey-darkest">
                    <div class="w-full flex flex-col justify-between p-6">
                        <div class="p-2">
                            <h2>Отели</h2>
                        </div>
                        <div class="p-2">
                            <p>Количество: {{ $countHotels }}</p>
                        </div>
                        <div class="flex justify-end">
                            <x-link-button class="flex items-center justify-center" href="{{ route('admin.hotels') }}">
                                Перейти
                            </x-link-button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded shadow-md flex card text-grey-darkest">
                    <div class="w-full flex flex-col justify-between p-6">
                        <div class="p-2">
                            <h2>Удобства</h2>
                        </div>
                        <div class="p-2">
                            <p>Количество: {{ $countFacilities }}</p>
                        </div>
                        <div class="flex justify-end">
                            <x-link-button class="flex items-end justify-end" href="{{ route('admin.facilities') }}">
                                Перейти
                            </x-link-button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded shadow-md flex card text-grey-darkest">
                    <div class="w-full flex flex-col justify-between p-6">
                        <div class="p-2">
                            <h2>Пользователи</h2>
                        </div>
                        <div class="p-2">
                            <p>Количество: {{ $countUsers }}</p>
                        </div>
                        <div class="flex justify-end">
                            <x-link-button class="flex items-end justify-end" href="{{ route('admin.users') }}">
                                Перейти
                            </x-link-button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded shadow-md flex card text-grey-darkest">
                    <div class="w-full flex flex-col justify-between p-6">
                        <div class="p-2">
                            <h2>Бронирования</h2>
                        </div>
                        <div class="p-2">
                            <p>Количество: {{ $countBookings }}</p>
                        </div>
                        <div class="flex justify-end">
                            <x-link-button class="flex items-end justify-end" href="{{ route('admin.bookings') }}">
                                Перейти
                            </x-link-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
