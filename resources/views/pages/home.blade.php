@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pb-10">
    <div class="mx-auto">
        <div class="bg-white px-4 py-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Explore Tutors</h2>
                <form action="{{ route('home') }}" method="GET" class="mt-4">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="w-full md:w-1/3">
                            <input type="text" name="search" placeholder="Search Tutors or Subjects" value="{{ request('search') }}" class="w-full px-3 py-2 border rounded-md">
                        </div>
                        <div class="w-full md:w-1/4">
                            <select name="school_level" class="w-full px-3 py-2 border rounded-md">
                                <option value="">All Levels</option>
                                @foreach($schoolLevels as $level)
                                    <option value="{{ $level->id }}" {{ request('school_level') == $level->id ? 'selected' : '' }}>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/4">
                            <select name="sort" class="w-full px-3 py-2 border rounded-md">
                                <option value="">Sort By</option>
                                <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>
                        <div class="w-full md:w-auto">
                            <button type="submit" class="w-full md:w-auto px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @include('tuition_postings.index', ['postings' => $postings])

        <div class="mt-6 px-4">
            {{ $postings->links() }}
        </div>
    </div>
</div>
@endsection