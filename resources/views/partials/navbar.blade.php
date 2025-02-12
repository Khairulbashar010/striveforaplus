<nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div>
                    <a href="{{ route('home') }}" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-gray-500 text-lg">StriveForA+</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Home</a>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">
                            Categories
                            <svg class="h-4 w-4 inline-block ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 w-48 bg-white rounded-md shadow-lg py-1 mt-1">
                            <a href="{{ route('home', ['category' => 'primary']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Primary</a>
                            <a href="{{ route('home', ['category' => 'lower-secondary']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lower Secondary</a>
                            <a href="{{ route('home', ['category' => 'upper-secondary']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Upper Secondary</a>
                        </div>
                    </div>
                    <a href="{{ route('home', ['sort' => 'latest']) }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Latest Postings</a>
                </div>
            </div>
            <div class="hidden md:flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-green-500 hover:text-white transition duration-300">Log In</a>
                    <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Sign Up</a>
                @else
                    <a href="{{ route('tuition_postings.create') }}" class="py-2 px-2 font-medium text-white bg-blue-500 rounded hover:bg-blue-400 transition duration-300">Create Posting</a>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-gray-200 transition duration-300">
                            {{ Auth::user()->name }}
                            <svg class="h-4 w-4 inline-block ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 w-48 bg-white rounded-md shadow-lg py-1 mt-1">
                            <a href="{{ route('dashboard.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
            <div class="md:hidden flex items-center">
                <button class="outline-none mobile-menu-button">
                    <svg class="w-6 h-6 text-gray-500 hover:text-green-500"
                        x-show="!showMenu"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="hidden mobile-menu">
        <ul class="">
            <li><a href="{{ route('home') }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Home</a></li>
            <li><a href="{{ route('home', ['category' => 'primary']) }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Primary</a></li>
            <li><a href="{{ route('home', ['category' => 'lower-secondary']) }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Lower Secondary</a></li>
            <li><a href="{{ route('home', ['category' => 'upper-secondary']) }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Upper Secondary</a></li>
            <li><a href="{{ route('home', ['sort' => 'latest']) }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Latest Postings</a></li>
            @guest
                <li><a href="{{ route('login') }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Log In</a></li>
                <li><a href="{{ route('register') }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Sign Up</a></li>
            @else
                <li><a href="{{ route('tuition_postings.create') }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Create Posting</a></li>
                <li><a href="{{ route('dashboard.profile') }}" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Logout</button>
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>

<script>
    const btn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
</script>

