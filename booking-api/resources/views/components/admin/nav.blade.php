<!-- resources/views/components/admin/nav.blade.php -->

<nav class="bg-gray-800 p-4">
    <ul class="flex space-x-4">
        <li>
            <a href="{{ route('voyager.dashboard') }}" class="text-white hover:text-gray-400">Админ</a>
        </li>
        <li>
            <a href="{{ route('voyager.hotels.index') }}" class="text-white hover:text-gray-400">Hotels</a>
        </li>
        <li>
            <a href="{{ route('voyager.users.index') }}" class="text-white hover:text-gray-400">Users</a>
        </li>
        <li>
            <a href="{{ route('voyager.bookings.index') }}" class="text-white hover:text-gray-400">Bookings</a>
        </li>
        <li>
            <a href="{{ route('voyager.facilities.index') }}" class="text-white hover:text-gray-400">Facilities</a>
        </li>
    </ul>
</nav>

