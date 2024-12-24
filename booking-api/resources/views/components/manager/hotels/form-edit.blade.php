<form action="{{ route('manager.hotel.update', Auth::user()->hotel_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <input type="hidden" name="id" value="{{ Auth::user()->hotel_id }}">
    <div class="mt-4">
        <label for="title">Название отеля</label>
        <input id="title" class="block mt-1 w-full" type="text"
                name="title" value="{{ $hotel->title }}" required autofocus>
    </div>
    <div class="mt-4">
        <label for="description">Описание отеля</label>
        <textarea id="description" class="block mt-1 w-full" type="text" name="description"
                    required autofocus>{{ $hotel->description }}</textarea>
    </div>
    <div class="mt-4">
        <label for="address">Адрес</label>
        <input id="address" class="block mt-1 w-full" type="text" name="address"
                value="{{ $hotel->address }}" required>
    </div>
    <div class="mt-4">
        <label for="facility_id">Выберите удобства</label>
        <span class="pr-2 text-xs">(для множественного выбора Ctrl + click)</span>
        <select id="facility_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                multiple size="3" name="facility[]">
            @foreach ($facilities as $facility)
                <option value="{{ $facility->id }}">{{ $facility->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-4">
        <label for="file" :value="__('')">Фото</label>
        <input id="file" class="block mt-1 w-full" type="file" name="file" :value="old('file')">
    </div>
    <div class="flex items-center justify-end mt-4">
        @if (Auth::user()->role_id === 3)
            <x-link-button href="{{ route('admin.hotels.rooms.create', $hotel->id) }}" class="ml-4">
                {{ __('Номера') }}
            </x-link-button>
        @else
            <x-link-button href="{{ route('manager.hotels.rooms.create', $hotel->id) }}" class="ml-4">
                {{ __('Номера') }}
            </x-link-button>
        @endif
        <x-button class="ml-4">
            {{ __('Сохранить') }}
        </x-button>
    </div>
</form>
