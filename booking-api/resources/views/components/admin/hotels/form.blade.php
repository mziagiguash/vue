<div class="py-8 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="bg-white rounded shadow-md flex card text-grey-darkest">
            <div class="w-full flex flex-col justify-between p-4">
                <h6>
                    Добавление отеля
                </h6>
                <div>
                </div>
                <div class="pt-2">
                    <form action="{{ route('admin.hotel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-4">
                            <label for="title">Название отеля</label>
                            <input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title') }}" required autofocus>
                        </div>
                        <div class="mt-4">
                            <label for="description">Описание отеля</label>
                            <textarea id="description" class="block mt-1 w-full" type="text" name="description" required autofocus>{{ old('description') }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label for="address">Адрес</label>
                            <input id="address" class="block mt-1 w-full" type="text" value="{{ old('address') }}" name="address" required>
                        </div>
                        <div class="mt-4">
                            <label for="facility_id">Выберите удобства</label>
                            <span class="pr-2 text-xs">(для множественного выбора Ctrl + click)</span>
                            <select id="facility_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                            focus:border-blue-500 block w-full p-2.5"
                                            multiple
                                            size="3"
                                            name="facility[]">
                                @foreach ($facilities as $facility)
                                    <option value="{{ $facility->id }}">{{ $facility->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="file" :value="__('')">Фото</label>
                            <input id="file" class="block mt-1 w-full" type="file" name="file" :value="old('file')" required>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Добавить') }}
                            </x-button>
                        </div>
                    </form>
                    @if ($errors->any())
                    <div class="text-red-800">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
