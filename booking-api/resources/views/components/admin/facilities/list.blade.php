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
                        Наименование
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50 w-100">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($facilities as $facility)
                <tr class="even:bg-blue-gray-50/50">
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $facility->id }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $facility->title }}
                        </p>
                    </td>
                    <td class="p-4">
                        <div class="font-sans text-sm antialiased font-medium text-blue-800">
                            <span class="pr-4">
                                <x-link-button href="{{ route('admin.facilities.edit', $facility->id) }}">Edit</x-link-button>
                            </span>
                            <span class="inline-block">
                                <form action="{{ route('admin.facilities.delete', $facility->id) }}" method="POST" class="pr-6">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" onclick="return confirm('Вы уверены?')">Delete</x-button>
                                </form>
                            </span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
