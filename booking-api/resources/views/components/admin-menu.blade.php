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
