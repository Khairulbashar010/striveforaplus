<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>StriveForA+ - Find the Best Tutors</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-black text-white">
  <!-- Navigation -->
  <nav class="bg-gray-900 shadow px-4 py-6">
    <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
      <!-- Logo & Mobile Menu Icon -->
      <div class="flex items-center space-x-3">
        <!-- Hamburger icon (mobile) -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-300 sm:hidden">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <h1 class="text-2xl font-bold">StriveForA+</h1>
      </div>
      <!-- Search Form -->
      <form method="GET" action="{{ route('home') }}" class="flex items-center bg-gray-800 rounded-lg px-4 py-2 w-full max-w-lg">
        <input type="text" name="search" placeholder="Search Tutors..."
               class="w-full bg-transparent outline-none text-white text-sm placeholder-gray-400 p-3" style="height: 50px;">
        <button type="submit" class="ml-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
          </svg>
        </button>
      </form>
      <!-- Filter Button -->
      <button id="filterButton" class="flex items-center space-x-2 bg-gray-800 text-white px-4 py-2 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 6h18M5 12h14m-7 6h7"/>
        </svg>
        <span>Filter</span>
      </button>
    </div>
  </nav>

  <!-- Filter Dropdown -->
  <div id="filterDropdown" class="container mx-auto bg-gray-900 p-6 mt-4 rounded-lg shadow hidden transition-all duration-300">
    <form method="GET" action="{{ route('home') }}" class="space-y-4">
      <label for="category" class="block text-white text-lg mb-2">Select Category:</label>
      <select name="category" id="category" class="w-full bg-gray-800 text-white p-3 rounded-lg border border-gray-700">
        <option value="">All</option>
        <option value="Primary" {{ request('category') == 'Primary' ? 'selected' : '' }}>Primary</option>
        <option value="Lower Secondary" {{ request('category') == 'Lower Secondary' ? 'selected' : '' }}>Lower Secondary</option>
        <option value="Upper Secondary" {{ request('category') == 'Upper Secondary' ? 'selected' : '' }}>Upper Secondary</option>
      </select>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg">Apply Filter</button>
    </form>
  </div>

  <!-- Hero Section -->
  <header class="container mx-auto py-10 px-4">
    <h2 class="text-4xl font-bold text-center">Find Private Tutors</h2>
    <p class="mt-4 text-center text-gray-300">Tutors post tuition details and students find the best match effortlessly.</p>
  </header>

  <!-- Authentication Section (if not logged in) -->
  @if(!auth()->check())
  <section class="container mx-auto p-6 bg-gray-800 rounded-lg shadow mb-8">
    <div class="flex flex-col md:flex-row gap-8">
      <!-- Login Form -->
      <div id="login" class="md:w-1/2">
        <h3 class="text-2xl font-semibold mb-4">Login</h3>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
          @csrf
          <div>
            <label for="login_email" class="block text-gray-300 mb-1">Email</label>
            <input type="email" name="email" id="login_email" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Email">
          </div>
          <div>
            <label for="login_password" class="block text-gray-300 mb-1">Password</label>
            <input type="password" name="password" id="login_password" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Password">
          </div>
          <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded">Login</button>
        </form>
      </div>
      <!-- Registration Form -->
      <div id="register" class="md:w-1/2">
        <h3 class="text-2xl font-semibold mb-4">Register</h3>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
          @csrf
          <div>
            <label for="name" class="block text-gray-300 mb-1">Name</label>
            <input type="text" name="name" id="name" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Your Name">
          </div>
          <div>
            <label for="reg_email" class="block text-gray-300 mb-1">Email</label>
            <input type="email" name="email" id="reg_email" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Email">
          </div>
          <div>
            <label for="reg_password" class="block text-gray-300 mb-1">Password</label>
            <input type="password" name="password" id="reg_password" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Password">
          </div>
          <div>
            <label for="password_confirmation" class="block text-gray-300 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Confirm Password">
          </div>
          <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded">Register</button>
        </form>
      </div>
    </div>
  </section>
  @endif

  <!-- Tuition Posting Form (For Logged-in Tutors) -->
  @if(auth()->check())
  <section class="container mx-auto p-6 bg-gray-800 rounded-lg shadow mb-8">
    <h3 class="text-2xl font-semibold mb-4">Create a Tuition Posting</h3>
    <form method="POST" action="{{ route('tuition.store') }}" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <div>
        <label for="subject" class="block text-gray-300 mb-1">Subject Taught</label>
        <input type="text" name="subject" id="subject" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="e.g. Mathematics">
      </div>
      <div>
        <label for="tuition_fee" class="block text-gray-300 mb-1">Tuition Fee</label>
        <input type="number" name="tuition_fee" id="tuition_fee" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="e.g. 50">
      </div>
      <div>
        <label for="max_students" class="block text-gray-300 mb-1">Maximum Number of Students</label>
        <input type="number" name="max_students" id="max_students" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="e.g. 5">
      </div>
      <div>
        <label for="school_level" class="block text-gray-300 mb-1">School Level</label>
        <select name="school_level" id="school_level" class="w-full p-3 rounded bg-gray-700 text-white">
          <option value="Primary">Primary</option>
          <option value="Lower Secondary">Lower Secondary</option>
          <option value="Upper Secondary">Upper Secondary</option>
        </select>
      </div>
      <div>
        <label for="image" class="block text-gray-300 mb-1">Upload Image (Optional)</label>
        <input type="file" name="image" id="image" class="w-full p-3 rounded bg-gray-700 text-white">
      </div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded">Post Tuition</button>
    </form>
  </section>
  @endif

  <!-- Tuition Postings Listing -->
  <section class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-gray-900 text-center mb-8">Tuition Postings</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($tuitions as $tuition)
      <div class="rounded-lg bg-white p-6 shadow hover:shadow-lg transition transform hover:scale-105">
        <div class="flex items-center space-x-4">
          <img class="h-12 w-12 rounded-full object-cover" src="{{ $tuition->image ? asset('storage/'.$tuition->image) : 'https://ui-avatars.com/api/?name=' . urlencode($tuition->tutor->name) . '&size=128' }}" alt="Tutor Profile">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">{{ $tuition->tutor->name }}</h3>
            <p class="text-sm text-gray-500">{{ $tuition->subject }}</p>
          </div>
        </div>
        <div class="mt-4 space-y-2">
          <p class="text-gray-700"><strong>Category:</strong> {{ $tuition->school_level }}</p>
          <p class="text-gray-700"><strong>Fee:</strong> ${{ $tuition->tuition_fee }}</p>
          <p class="text-gray-700"><strong>Max Students:</strong> {{ $tuition->max_students }}</p>
          <p class="text-sm text-gray-500">Posted on {{ $tuition->created_at->format('M d, Y') }}</p>
        </div>
      </div>
      @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
      {{ $tuitions->links() }}
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 py-4 mt-10">
    <div class="container mx-auto text-center text-gray-500">
      &copy; {{ date('Y') }} striveForA+. All rights reserved.
    </div>
  </footer>

  <!-- JavaScript for Filter Toggle -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const filterButton = document.getElementById('filterButton');
      const filterDropdown = document.getElementById('filterDropdown');
      filterButton.addEventListener('click', function () {
        filterDropdown.classList.toggle('hidden');
      });
    });
  </script>
</body>
</html>