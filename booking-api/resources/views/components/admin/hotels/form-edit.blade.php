<form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="mt-4">
        <label for="title">Название отеля</label>
        <input id="title" class="block mt-1 w-full" type="text"
               name="title" value="{{ old('title', $hotel->title) }}" required autofocus>
    </div>

    <div class="mt-4">
        <label for="description">Описание отеля</label>
        <textarea id="description" class="block mt-1 w-full" name="description" required>
            {{ old('description', $hotel->description) }}
        </textarea>
    </div>

    <div class="mt-4">
        <label for="address">Адрес</label>
        <input id="address" class="block mt-1 w-full" type="text" name="address"
               value="{{ old('address', $hotel->address) }}" required>
    </div>

    <div class="mt-4">
        <label for="facility_id">Выберите удобства</label>
        <span class="pr-2 text-xs">(для множественного выбора Ctrl + click)</span>
        <select id="facility_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                multiple size="3" name="facility[]">
            @foreach ($facilities as $facility)
                <option value="{{ $facility->id }}"
                        {{ in_array($facility->id, $hotel->facilities->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $facility->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-4">
        <label for="file">Фото</label>
        <input id="file" class="block mt-1 w-full" type="file" name="file">
        @if ($hotel->poster_url)
            <img src="{{ Storage::url($hotel->poster_url) }}" alt="Фото отеля" class="mt-2" width="150">
        @endif
    </div>

    <div class="mt-4">
        @if ($errors->any())
            <div class="text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Сохранить') }}
        </x-button>
    </div>
</form>
