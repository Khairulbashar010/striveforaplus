@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Tuition Postings</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($postings as $posting)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if ($posting->image)
                    <img src="{{ asset('storage/' . $posting->image) }}" alt="{{ $posting->subject }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $posting->subject }}</h2>
                    <p class="text-gray-600 mb-2">{{ $posting->schoolLevel->name }}</p>
                    <p class="text-gray-600 mb-2">Tutor: {{ $posting->user->name }}</p>
                    <p class="text-gray-600 mb-2">Fee: ${{ number_format($posting->fee, 2) }}</p>
                    <p class="text-gray-600 mb-2">Max Students: {{ $posting->max_students }}</p>
                    @if ($posting->description)
                        <p class="text-gray-600 mb-2">{{ Str::limit($posting->description, 100) }}</p>
                    @endif
                    @can('update', $posting)
                        <a href="{{ route('tuition_postings.edit', $posting) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Edit</a>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $postings->links() }}
    </div>
@endsection

