<div class="rooms-table-admin">
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
                    Название
                </p>
            </th>
            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Описание
            </p>
            </th>
            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                    Площадь
                </p>
            </th>
            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                    Тип
                </p>
            </th>
            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                    Цена
                </p>
            </th>
            <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr class="even:bg-blue-gray-50/50">
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $room->id }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $room->title }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $room->description }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $room->floor_area }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $room->type }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $room->price }}
                        </p>
                    </td>
                    <td class="p-4">
                        <span class="pr-4">
                            @if (Auth::user()->role_id === 1)
                                <x-link-button class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900"
                                                href="{{ route('admin.rooms.edit', $room->id) }}">Edit</x-link-button>
                                <span class="inline-block">
                                    <form action="{{ route('admin.rooms.delete', $room->id) }}" method="POST" class="pr-6">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="submit" onclick="return confirm('Вы уверены?')">Delete</x-button>
                                    </form>
                                </span>
                            @else
                                <x-link-button class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900"
                                                href="{{ route('manager.rooms.edit', $room->id) }}">Edit</x-link-button>
                                <span class="inline-block pr-4">
                                    <form action="{{ route('manager.rooms.delete', $room->id) }}" method="POST" class="pr-6">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="submit" onclick="return confirm('Вы уверены?')">Delete</x-button>
                                    </form>
                                </span>
                            @endif
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
