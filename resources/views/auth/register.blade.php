@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg rounded-lg">
        <h3 class="text-2xl font-bold text-center">Register a New Account</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mt-4">
                <div>
                    <label class="block" for="name">Name<label>
                    <input type="text" placeholder="Name" id="name" name="name"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block" for="email">Email<label>
                    <input type="text" placeholder="Email" id="email" name="email"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block">Password<label>
                    <input type="password" placeholder="Password" id="password" name="password"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block">Confirm Password<label>
                    <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex items-baseline justify-between">
                    <button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Register</button>
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Already have an account?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

