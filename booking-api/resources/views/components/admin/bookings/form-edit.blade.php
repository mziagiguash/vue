<div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="bg-white rounded shadow-md flex card text-grey-darkest">
            <div class="w-full flex flex-col justify-between p-4">
                <h6>
                    Измненние статуса бронирования
                </h6>
                <div>
                </div>
                <div class="pt-2">
                    @if (Auth::user()->role_id === 1)
                        <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST" id="{{ $booking->id }}">
                    @else
                        <form action="{{ route('manager.booking.update', $booking->id) }}" method="POST" id="{{ $booking->id }}">
                    @endif
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $booking->id }}">
                        <div class="mt-4">
                            Бронирование # {{ $booking->id }}
                        </div>
                        <div class="mt-4">
                            <p>Отель {{ $booking->room->hotel->title }}</p>
                        </div>
                        <div class="mt-4">
                            <p>Номер {{ $booking->room->title }}</p>
                        </div>
                        <div class="mt-4 mb-4">
                            <p>Клиент {{ $booking->user->name }} {{ $booking->user->surname }}</p>
                        </div>
                        <div class="mb-4">
                            <label >Изменить статус бронирования:
                                <select name="status_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($statuses as $status)
                                        <option {{ $booking->status_id === $status->id ? 'selected' : '' }}
                                                    value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </label>
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
