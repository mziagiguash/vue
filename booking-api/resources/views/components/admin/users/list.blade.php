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
                        Имя
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Email
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Email подтвержден
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Роль
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                        Менеджер отеля
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50 w-100">
                    <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70"></p>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="even:bg-blue-gray-50/50">
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $user->id }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $user->name }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $user->surname }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $user->email }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            @if (!empty($user->email_verified_at))
                                ДА
                            @else
                                НЕТ
                            @endif
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            {{ $user->role->name }}
                        </p>
                    </td>
                    <td class="p-4">
                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                            @if (!empty($user->hotel->title))
                                {{ $user->hotel->title }}
                            @endif
                        </p>
                    </td>
                    <td class="p-4">
                        <div>
                            <span class="pr-4">
                                <x-link-button href="{{ route('admin.user.edit', $user->id) }}"
                                    class="font-sans text-sm antialiased font-medium">Edit</x-link-button>
                            </span>
                            <span class="inline-block hover">
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="pr-6">
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
