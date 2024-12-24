<div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="bg-white rounded shadow-md flex card text-grey-darkest">
            <div class="w-full flex flex-col justify-between p-4">
                <h6>Редактирование удобства</h6>
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
                <div class="pt-2">
                    <form action="{{ route('admin.facility.update', $facility->id) }}" method="POST" id="{{ $facility->id }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $facility->id }}">
                        <div class="mt-4">
                            <input id="name" class="block mt-1 w-full" type="text" name="title" value="{{ $facility->title }}" required autofocus>
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
