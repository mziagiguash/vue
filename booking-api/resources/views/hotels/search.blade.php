<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen bg-gray-50">
        @include('layouts.navigation')

        <!-- Поиск отелей -->
        <div class="bg-white p-6 rounded-lg shadow-md">
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

                <!-- Поле для количества людей -->
                <div>
                    <label for="adults" class="block text-sm font-medium text-gray-700">2 взрослых · 0 детей · 1 номер</label>
                    <input type="number" id="adults" name="adults" value="2" min="1" max="10" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Удобства (чекбоксы) -->
                <div class="col-span-1 sm:col-span-2 lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700">Удобства</label>
                    <div class="mt-2">
                        @foreach ($facilities as $facility)
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

        <!-- Результаты поиска -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-900">Результаты поиска</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($hotels as $hotel)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $hotel->name }}</h3>
                        <p class="text-gray-600">{{ $hotel->destination }}</p>
                        <p class="text-gray-600">Дата заезда: {{ \Carbon\Carbon::parse($hotel->check_in_date)->format('d.m.Y') }}</p>
                        <p class="text-gray-600">Дата отъезда: {{ \Carbon\Carbon::parse($hotel->check_out_date)->format('d.m.Y') }}</p>
                        <p class="text-gray-600">Цена: {{ number_format($hotel->price, 0, '.', ' ') }} руб.</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
