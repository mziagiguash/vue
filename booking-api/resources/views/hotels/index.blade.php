<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Список отелей</h1>

        <!-- Форма поиска -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <form action="{{ route('hotels.search') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Поле для места назначения -->
                <div>
                    <label for="destination" class="block text-sm font-medium text-gray-700">Куда вы хотите поехать?</label>
                    <input type="text" id="destination" name="destination" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Город, регион или страна">
                </div>

                <!-- Поле для даты заезда -->
                <div>
                    <label for="check_in_date" class="block text-sm font-medium text-gray-700">Дата заезда</label>
                    <input type="date" id="check_in_date" name="check_in_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Поле для даты отъезда -->
                <div>
                    <label for="check_out_date" class="block text-sm font-medium text-gray-700">Дата отъезда</label>
                    <input type="date" id="check_out_date" name="check_out_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Поле для удобств -->
                <div class="col-span-1 sm:col-span-2 lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700">Удобства</label>
                    <div class="mt-2">
                        @foreach (\App\Models\Facility::all() as $facility)
                            <div class="flex items-center">
                                <input type="checkbox" id="facility_{{ $facility->id }}" name="facilities[]" value="{{ $facility->id }}" class="mr-2">
                                <label for="facility_{{ $facility->id }}" class="text-sm">{{ $facility->title }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Кнопка поиска -->
                <div class="col-span-1 sm:col-span-2 lg:col-span-1 flex justify-center items-center">
                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Найти
                    </button>
                </div>
            </form>
        </div>

        <!-- Список отелей -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($hotels as $hotel)
                <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
            @endforeach
        </div>
    </div>
</x-app-layout>

