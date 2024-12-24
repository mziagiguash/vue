<div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="bg-white rounded shadow-md flex card text-grey-darkest">
            <div class="w-full flex flex-col justify-between p-4">
                <h6>
                    Редактирование пользователя
                </h6>
                <div>
                </div>
                <div class="pt-2">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="{{ $user->id }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="mt-4">
                            <p class="w-1/2">Имя:</p>
                            <p class="w-1/2">{{ $user->name }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="w-1/2">Email:</p>
                            <p class="w-1/2">{{ $user->email }}</p>
                        </div>
                        <div class="mt-4">
                            <label class="mr-4">Роль:</label>
                            @foreach ($roles as $role)
                                <span class="pr-4">
                                    <input type="radio" id="role" name="role_id" value="{{ $role->id }}" {{ $role->id == $user->role->id ? 'checked' : '' }}/>
                                    <label for="role">{{ $role->name }}</label>
                                </span>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <label >Назначить менеджера отеля:</label>
                                <select name="hotel_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="0">Нет отеля</option>
                                    @foreach ($hotels as $hotel)
                                        <option {{ $user->hotel_id == $hotel->id ? 'selected' : '' }}
                                                     value="{{ $hotel->id }}">{{ $hotel->title }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Сохранить') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
