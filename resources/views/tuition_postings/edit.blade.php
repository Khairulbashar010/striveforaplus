@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Edit Tuition Posting</h1>

    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <form action="{{ route('tuition_postings.update', $tuitionPosting->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="school_level_id">School Level</label>
            <select name="school_level_id" id="school_level_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($schoolLevels as $level)
                    <option value="{{ $level->id }}" {{ $tuitionPosting->school_level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">Subject</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="subject" type="text" name="subject" value="{{ $tuitionPosting->subject }}" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fee">Fee (per hour)</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="fee" type="number" name="fee" step="0.01" value="{{ $tuitionPosting->fee }}" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="max_students">Max Students</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="max_students" type="number" name="max_students" value="{{ $tuitionPosting->max_students }}" required>
        </div>

        <!-- Description Field with CKEditor -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                      id="description" name="description" rows="4">{!! $tuitionPosting->description !!}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Image</label>
            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

            
            @if ($tuitionPosting->image)
                @if (Str::startsWith($tuitionPosting->image, 'https'))
                    <img class="mt-2 w-32 h-32 object-cover" src="{{ $tuitionPosting->image }}" alt="Tuition Image">
                @else
                    <img class="mt-2 w-32 h-32 object-cover" src="{{ Storage::url($tuitionPosting->image) }}" alt="Tuition Image">
                @endif
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Posting
            </button>

            <!-- Delete Button -->
            <button type="button" onclick="confirmDelete('{{ $tuitionPosting->id }}')" 
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Delete
            </button>
        </div>
    </form>

    <!-- Hidden Delete Form -->
    <form id="delete-form-{{ $tuitionPosting->id }}" action="{{ route('tuition_postings.destroy', $tuitionPosting->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- CKEditor Script -->
		<script>
		const {
			ClassicEditor,
			Essentials,
			Bold,
			Italic,
			Font,
			Paragraph
		} = CKEDITOR;

		ClassicEditor
			.create( document.querySelector( '#description' ), {
                licenseKey: '{{ env('CKEDITOR_LICENSE_KEY') }}',
				plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
				toolbar: [
					'undo', 'redo', '|', 'bold', 'italic', '|',
					'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
				]
			} )
				.then( editor => {
					window.editor = editor;
				} )
				.catch( error => {
					console.error( error );
				} );
		</script>
    <script>
        function confirmDelete(postingId) {
            if (confirm("Are you sure you want to delete this posting?")) {
                document.getElementById("delete-form-" + postingId).submit();
            }
        }
    </script>
@endsection