@extends('layouts.admin')

@section('content')
    <div class="flex">
        <!-- Top Navigation -->
        <x-admin.nav />

        <!-- Main content -->
        <div class="flex-1 p-6">
            <!-- Контент главной страницы администратора -->
            <h1 class="text-2xl font-semibold">Admin Dashboard</h1>

            <!-- Рендеринг меню -->
            <nav class="bg-gray-200 p-4 rounded">
                <ul class="space-y-2">
                    @foreach($menuItems as $menuItem)
                        <li>
                            <a
                                href="{{ $menuItem->link() }}"
                                class="text-blue-600 hover:underline"
                            >
                                {{ $menuItem->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <!-- Дополнительный контент -->
            <ul>
                <li>Users: {{ $countUsers }}</li>
                <li>Hotels: {{ $countHotels }}</li>
                <li>Facilities: {{ $countFacilities }}</li>
                <li>Bookings: {{ $countBookings }}</li>
            </ul>
        </div>
    </div>
@endsection
