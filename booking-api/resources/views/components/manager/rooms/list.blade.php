<div class="py-6 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">

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
                    <a href="{{ route('admin.rooms.edit', $room->id) }}"
                        class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900">Edit</a>
                </td>
                <td class="p-4">
                    <a href="{{ route('admin.rooms.delete', $room->id) }}"
                        class="block font-sans text-sm antialiased font-medium leading-normal text-gray-900"
                        onclick="return confirm('Вы уверены?')">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>
</div>
