<div class="pt-2">
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
<form action="{{ route('admin.hotels.rooms.store', $hotel->id) }}" method="POST" enctype="multipart/form-data">
@csrf
    <input type="hidden" value="{{ $hotel->id }}">
    <div class="mt-4">
        <label for="title">Название</label>
        <input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title') }}" autofocus>
    </div>
    <div class="mt-4">
        <label for="description">Описание</label>
        <textarea id="description" class="block mt-1 w-full" type="text" name="description">{{ old('description') }}</textarea>
    </div>
    <div class="mt-4">
        <label for="floor_area">Площадь</label>
        <input id="floor_area" class="block mt-1 w-full" type="number" name="floor_area" value="{{ old('floor_area') }}" >
    </div>
    <div class="mt-4">
        <label for="type">Тип</label>
        <input id="type" class="block mt-1 w-full" type="text" name="type" value="{{ old('type') }}">
    </div>
    <div class="mt-4">
        <label for="price">Цена</label>
        <input id="price" class="block mt-1 w-full" type="number" name="price" value="{{ old('price') }}">
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
        <label for="file">Фото</label>
        <input id="file" class="block mt-1 w-full" type="file" name="file" :value="{{ old('file') }}">
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Добавить') }}
        </x-button>
    </div>
</form>
