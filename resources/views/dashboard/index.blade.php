@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Welcome, {{ Auth::user()->name }}!</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-xl font-semibold mb-2">Your Tuition Postings</h3>
                @if(Auth::user()->tuitionPostings->count() > 0)
                    <ul class="list-disc list-inside">
                        @foreach(Auth::user()->tuitionPostings as $posting)
                            <li>
                                <a href="{{ route('tuition_postings.edit', $posting) }}" class="text-blue-600 hover:underline">
                                    {{ $posting->subject }} ({{ $posting->schoolLevel->name }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>You haven't created any tuition postings yet.</p>
                @endif
                <a href="{{ route('tuition_postings.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Create New Posting</a>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Quick Stats</h3>
                <p>Total Postings: {{ Auth::user()->tuitionPostings->count() }}</p>
                <!-- Add more stats as needed -->
            </div>
        </div>
    </div>
</div>
@endsection

