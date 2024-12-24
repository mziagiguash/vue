<x-app-layout>
    <x-admin.nav />
    @if($users->isNotEmpty())
        <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container xl:mx-auto">
            <x-admin.users.list :users="$users" />
        </div>
    @endif
</x-app-layout>
