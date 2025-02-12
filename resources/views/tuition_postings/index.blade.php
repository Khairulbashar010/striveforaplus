<div class="px-4 mt-6">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($postings as $posting)
                <div class="relative rounded-lg bg-white shadow-md hover:shadow-lg transition-all duration-300">
                    
                    @if (auth()->check() && auth()->id() === $posting->user_id)
                    <a href="{{ route('tuition_postings.edit', $posting->id) }}" 
                    class="absolute top-3 right-3 bg-yellow-500 py-2 px-4 rounded-md hover:bg-yellow-600 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" x="0px" y="0px" width="15" height="15" viewBox="0 0 50 50">
                        <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z"></path>
                    </svg>
                    </a>
                    @endif

                    <!-- Image Section -->
                    <a href="{{ route('tuition_postings.show', $posting->id) }}" class="block">
                        <div class="h-48 w-full overflow-hidden rounded-t-lg">
                            @if ($posting->image)
                                @if (Str::startsWith($posting->image, 'https'))
                                    <img class="w-full h-full object-cover" src="{{ $posting->image }}" alt="Tuition Image">
                                @else
                                    <img class="w-full h-full object-cover" src="{{ Storage::url($posting->image) }}" alt="Tuition Image">
                                @endif
                            @else
                                <img class="w-full h-full object-cover" src="https://via.placeholder.com/400x300?text=No+Image" alt="Default Image">
                            @endif
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="flex items-center">
                                @if ($posting->user->photo)
                                    <img class="mr-2 h-10 w-10 rounded-full object-cover" src="{{ asset('storage/'.$posting->user->photo) }}" alt="{{ $posting->user->name }}">
                                @else
                                    <img class="mr-2 h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($posting->user->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $posting->user->name }}">
                                @endif
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900">{{ $posting->user->name }}</h3>
                                    <span class="block text-xs font-normal text-gray-500">{{ $posting->subject }}</span>
                                </div>
                            </div>

                            <p class="my-4 text-sm font-normal text-gray-500">
                                {!! Str::limit(strip_tags($posting->description), 100) !!}
                            </p>

                            @if (strlen(strip_tags($posting->description)) > 100)
                                <a href="{{ route('tuition_postings.show', $posting->id) }}" class="text-green-500 text-sm font-semibold hover:underline">
                                    Read More
                                </a>
                            @endif
                            <div class="mt-4 flex items-center justify-between text-sm font-semibold text-gray-900">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                    </svg>
                                    {{ $posting->schoolLevel->name }}
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                    </svg>
                                    ${{ number_format($posting->fee, 2) }} / hour
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
    </div>
</div>