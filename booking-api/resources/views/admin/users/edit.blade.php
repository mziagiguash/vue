<x-app-layout>
    <x-admin.nav />
    <x-admin.users.form-edit :user="$user" :roles="$roles" :hotels="$hotels" />
</x-app-layout>
