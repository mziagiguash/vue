<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Редактировать бронирование</h1>

        <form action="{{ route('bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="bg-white p-6 rounded-md shadow-md">
                <div class="mb-4">
                    <label for="started_at" class="text-sm font-semibold text-gray-600">Дата начала</label>
                    <input type="date" id="started_at" name="started_at" value="{{ $booking->started_at->format('Y-m-d') }}" class="w-full p-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="finished_at" class="text-sm font-semibold text-gray-600">Дата окончания</label>
                    <input type="date" id="finished_at" name="finished_at" value="{{ $booking->finished_at->format('Y-m-d') }}" class="w-full p-2 border rounded-md" required>
                </div>
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md mt-6">Обновить бронирование</button>
            </div>
        </form>
    </div>
</x-app-layout>
