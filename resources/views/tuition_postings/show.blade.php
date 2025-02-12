@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md relative">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="absolute top-4 left-4 text-gray-600 px-4 py-2 rounded-md hover:text-gray-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>

        <!-- Image -->
        @if ($tuition->image)
            @if (Str::startsWith($tuition->image, 'https'))
                <img class="w-full h-64 object-cover rounded-lg mt-10" src="{{ $tuition->image }}" alt="Tuition Image">
            @else
                <img class="w-full h-64 object-cover rounded-lg mt-10" src="{{ Storage::url($tuition->image) }}" alt="Tuition Image">
            @endif
        @else
            <img class="w-full h-64 object-cover rounded-lg mt-10" src="https://via.placeholder.com/600x400?text=No+Image" alt="Default Image">
        @endif

        <!-- Details -->
        <h2 class="text-3xl font-semibold text-gray-900 mt-4">{{ $tuition->subject }}</h2>
        <p class="text-gray-600 mt-2">By: {{ $tuition->user->name }}</p>

        <div class="mt-4 flex justify-between text-gray-800">
            <p><strong>School Level:</strong> {{ $tuition->schoolLevel->name }}</p>
            <p><strong>Max Students:</strong> {{ $tuition->max_students }}</p>
        </div>

        <p class="mt-4 text-gray-700">{!! $tuition->description !!}</p>

        <p class="mt-4 text-lg font-semibold text-gray-900">${{ number_format($tuition->fee, 2) }} / hour</p>

        @if (auth()->check() && auth()->id() === $tuition->user_id)
            <div class="mt-6 text-left">
                <a href="{{ route('tuition_postings.edit', $tuition->id) }}" 
                   class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 inline-flex items-center">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="white" x="0px" y="0px" width="15" height="15" viewBox="0 0 50 50" class="mr-2">
                        <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z"></path>
                    </svg>
                    Edit Tuition
                </a>
            </div>
        @else
            <div class="mt-6 text-left">
                <a href="mailto:{{ $tuition->user->email }}" 
                   class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 inline-flex items-center">
                    Contact Tutor
                </a>
            </div>
        @endif
    </div>
</div>
@endsection