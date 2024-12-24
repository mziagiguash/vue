<form action="{{ route('manager.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <input type="hidden" value="{{ $room->id }}">
    <input type="hidden" value="{{ $room->hotel_id }}">
    <div class="mt-4">
        <label for="title">Название номера</label>
        <input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $room->title }}" required autofocus>
    </div>
    <div class="mt-4">
        <label for="description">Описание</label>
        <textarea id="description" class="block mt-1 w-full" type="text" name="description" required autofocus>{{ $room->description }}</textarea>
    </div>
    <div class="mt-4">
        <label for="floor_area">Площадь</label>
        <input id="floor_area" class="block mt-1 w-full" type="number" name="floor_area" value="{{ $room->floor_area }}" required>
    </div>
    <div class="mt-4">
        <label for="type">Тип</label>
        <input id="type" class="block mt-1 w-full" type="text" name="type" value="{{ $room->type }}" required>
    </div>
    <div class="mt-4">
        <label for="price">Цена</label>
        <input id="price" class="block mt-1 w-full" type="number" name="price" value="{{ $room->price }}" required>
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
        <input id="file" class="block mt-1 w-full" type="file" name="file" :value="{{ $room->file }}">
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Сохранить') }}
        </x-button>
    </div>
</form>
