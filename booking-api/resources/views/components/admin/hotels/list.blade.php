<div class="hotel-table-admin">
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
                <p class="block font-sans text-sm font-normal leading-none text-blue-gray-900 opacity-70">
                    Описание
                </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                    Адрес
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach($hotels as $hotel)
                    <tr class="even:bg-blue-gray-50/50">
                        <td class="p-4">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                {{ $hotel->id }}
                            </p>
                        </td>
                        <td class="p-4">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                {{ $hotel->title }}
                            </p>
                        </td>
                        <td class="p-4 columns-2xl">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                {{ $hotel->description }}
                            </p>
                        </td>
                        <td class="p-4">
                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                {{ $hotel->address }}
                            </p>
                        </td>
                        <td class="p-4">
                            <x-link-button href="{{ route('admin.hotels.rooms.create', $hotel->id) }}" class="mr-4">
                                {{ __('Номера') }}
                            </x-link-button>
                            <span class="pr-4">
                                <x-link-button href="{{ route('admin.hotel.edit', $hotel->id) }}" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-900">Edit</x-link-button>
                            </span>
                            <span class="inline-block">
                                <form action="{{ route('admin.hotel.delete', $hotel->id) }}" method="POST" class="pr-6">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" onclick="return confirm('Вы уверены?')">Delete</x-button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="page justify-center mt-10 mb-10 mr-10">
        {{ $hotels->withQueryString()->links() }}
    </div>
</div>
