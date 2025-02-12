<nav class="bg-white shadow-lg" x-data="{ showMenu: false }">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div>
                    <a href="{{ route('home') }}" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-gray-500 text-lg">StriveForA+</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="py-4 px-2 font-semibold transition duration-300 {{ request()->routeIs('home') ?  'text-green-500' : 'text-gray-500 hover:text-green-500' }}">
                    Home
                </a>
                    @auth
                    <a href="{{ route('tuition_postings.create') }}" class="py-4 px-2 font-semibold transition duration-300 {{ request()->routeIs('tuition_postings.create') ? 'text-green-500' : 'text-gray-500 hover:text-green-500' }}">
                        Create Posting
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Desktop User Menu -->
            <div class="hidden md:flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-green-500 hover:text-white transition duration-300">Log In</a>
                    <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Sign Up</a>
                @else
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <span class="hidden md:block font-medium">{{ Auth::user()->name }}</span>
                            <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button @click="showMenu = !showMenu" class="mobile-menu-button">
                    <svg class="w-6 h-6 text-gray-500 hover:text-green-500"
                        x-show="!showMenu"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div x-show="showMenu" @click.away="showMenu = false" class="md:hidden mobile-menu bg-white shadow-lg absolute top-0 left-0 w-full p-6 transition-all duration-300 ease-in-out">
        <!-- Close Button -->
        <div class="flex justify-end">
            <button @click="showMenu = false" class="text-gray-600 hover:text-gray-800 text-2xl font-bold">
                &times;
            </button>
        </div>

        <ul class="mt-2">
            <li><a href="{{ route('home') }}" class="block text-sm px-4 py-2 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Home</a></li>
            @auth
                <li><a href="{{ route('tuition_postings.create') }}" class="block text-sm px-4 py-2 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Create Posting</a></li>
                <li><a href="{{ route('dashboard') }}" class="block text-sm px-4 py-2 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Dashboard</a></li>
                <li><a href="{{ route('profile.edit') }}" class="block text-sm px-4 py-2 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left text-sm px-4 py-2 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="block text-sm px-4 py-2 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Login</a></li>
                <li><a href="{{ route('register') }}" class="block text-sm px-4 py-2 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Register</a></li>
            @endauth
        </ul>
    </div>
</nav>