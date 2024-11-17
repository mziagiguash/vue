<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Мои бронирования</h1>
            <a href="{{ route('bookings.create', ['room' => 1]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Создать бронирование</a>
        </div>

        <div class="mt-6">
            @foreach ($bookings as $booking)
                <div class="bg-white p-4 rounded-md shadow-md mb-4">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-xl font-semibold">
                                @if($booking->room && $booking->room->hotel)
                                    {{ $booking->room->hotel->name }} - {{ $booking->room->name }}
                                @else
                                    Неизвестный отель
                                @endif
                            </h3>
                            <p class="text-sm text-gray-600">
                                Дата начала: {{ \Carbon\Carbon::parse($booking->started_at)->format('d.m.Y') }} |
                                Дата окончания: {{ \Carbon\Carbon::parse($booking->finished_at)->format('d.m.Y') }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('bookings.show', $booking) }}" class="text-blue-600 hover:text-blue-800">Просмотр</a>
                            <a href="{{ route('bookings.edit', $booking) }}" class="text-green-600 hover:text-green-800">Редактировать</a>
                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить это бронирование?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
