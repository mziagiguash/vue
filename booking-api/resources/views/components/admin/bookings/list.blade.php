<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md bg-clip-border rounded-xl">
    <table class="w-full text-left table-auto min-w-max">
        <thead>
            <tr>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        #
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Отель
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Номер
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Клиент
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        <span>Количество</span> </br> <span>дней</span>
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Стоимость
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Дата начала
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Дата окончания
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Дата бронирования
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Статус
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50 w-100">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
                </th>
            </tr>
        </thead>
            <tbody>
                @foreach($bookings as $booking)
                    @can('update', $booking)
                        <tr class="even:bg-blue-gray-50/50">
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $booking->id }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $booking->room->hotel->title }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $booking->room->title }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $booking->user->name }} {{ $booking->user->surname }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $booking->days }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $booking->price * $booking->days }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->started_at)->format('d.m.Y') }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->finished_at)->format('d.m.Y') }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $booking->created_at->format('d.m.Y') }}
                                </p>
                            </td>
                            <td class="p-4">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $booking->status->name }}
                                </p>
                            </td>
                            <td class="p-4">
                                @if (Auth::user()->role_id === 3)
                                    <div>
                                        <span class="pr-4">
                                            <x-link-button href="{{ route('admin.booking.edit', $booking->id) }}"
                                                            class="font-sans text-sm antialiased font-medium">Edit</x-link-button>
                                        </span>
                                    </div>
                                @else
                                    <div>
                                        <span class="pr-4">
                                            <x-link-button  href="{{ route('manager.booking.edit', $booking->id) }}"
                                                            class="font-sans text-sm antialiased font-medium">Edit</x-link-button>
                                        </span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endcan
                @endforeach
            </tbody>
    </table>

    <div class="justify-content-end">
        {{ $bookings->withQueryString()->links() }}
    </div>
  </div>
