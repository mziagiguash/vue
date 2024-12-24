<x-app-layout>
    <x-admin.nav />
    <x-admin.facilities.form />
    @if($facilities->isNotEmpty())
        <x-admin.facilities.list :facilities="$facilities" />
    @endif
</x-app-layout>
