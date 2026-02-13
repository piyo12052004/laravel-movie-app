<nav class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Pojok kiri: Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-xl font-bold">Movie</a>
            </div>

            <!-- Tengah: Menu Desktop -->
            <div class="hidden md:flex space-x-4 mx-auto">
                <a href="{{ url('/') }}" class="hover:bg-gray-700 px-3 py-2 rounded">{{__('Home')}}</a>
                <a href="{{ url('/details') }}" class="hover:bg-gray-700 px-3 py-2 rounded">{{__('Detail')}}</a>
            </div>

            <!-- Pojok kanan: User / Icon -->
            <div class="flex items-center space-x-4">
                @php $lang = app()->getLocale(); @endphp

                <div class=" text-sm space-x-2">
                    <a href="/lang/en"
                        class="px-2 py-1 rounded {{ $lang == 'en' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                        EN
                    </a>

                    <a href="/lang/id"
                        class="px-2 py-1 rounded {{ $lang == 'id' ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' }}">
                        ID
                    </a>
                </div>
                <!-- Profile + Logout -->
                <div class="relative inline-block text-left">
                    <button type="button"
                        class="hover:bg-gray-700 px-3 py-2 rounded flex items-center focus:outline-none"
                        id="menu-button" aria-expanded="true" aria-haspopup="true">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A12.072 12.072 0 0112 15c2.21 0 4.274.634 6 1.725M12 12a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                        {{ auth()->user()->name ?? 'Profile' }}
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu"
                        class="hidden origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                        <div class="py-1 text-gray-700">
                            <form method="POST" action="{{ route('logout') }}">
                                {{ csrf_field() }}
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-gray-100">{{__('Logout')}}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Hamburger Mobile -->
                <div class="hidden">
                    <button id="mobile-menu-btn" class="focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden hidden bg-gray-700">
        <a href="{{ url('/') }}" class="block px-4 py-2 hover:bg-gray-600">Home</a>
        <a href="{{ url('/about') }}" class="block px-4 py-2 hover:bg-gray-600">About</a>
        <a href="{{ url('/contact') }}" class="block px-4 py-2 hover:bg-gray-600">Contact</a>
        <a href="{{ url('/profile') }}" class="block px-4 py-2 hover:bg-gray-600 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A12.072 12.072 0 0112 15c2.21 0 4.274.634 6 1.725M12 12a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
            {{ auth()->user()->name ?? 'Profile' }}
        </a>
    </div>
</nav>

<script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    const menuButton = document.getElementById('menu-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    menuButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Klik di luar dropdown untuk menutup
    window.addEventListener('click', function(e) {
        if (!menuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
