    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div class="bg-white rounded shadow-md flex card text-grey-darkest">
        <div class="w-full flex flex-col justify-between p-4">
            <h6>
                Добавление удобств
            </h6>
            <div>
            </div>
            <div class="pt-2">
                <form action="{{ route('admin.hotels.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4">
                        <label for="title">Название</label>
                        <input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title') }}" required autofocus>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Добавить') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
