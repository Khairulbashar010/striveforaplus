<?php

namespace App\Http\Controllers;

use App\Models\TuitionPosting;
use App\Models\SchoolLevel;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TuitionPostingController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = TuitionPosting::with('user', 'schoolLevel');

        // Filter by category
        if ($request->has('category')) {
            $category = $request->get('category');
            $query->whereHas('schoolLevel', function ($q) use ($category) {
                $q->where('name', 'like', '%' . str_replace('-', ' ', $category) . '%');
            });
        }

        // Sort by latest
        if ($request->get('sort') === 'latest') {
            $query->latest();
        }

        $postings = $query->paginate(10);
        return view('tuition_postings.index', compact('postings'));
    }

    public function create()
    {
        $schoolLevels = SchoolLevel::all();
        return view('tuition_postings.create', compact('schoolLevels'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'school_level_id' => 'required|exists:school_levels,id',
            'subject' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
            'max_students' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tuition_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['user_id'] = auth()->id();

        TuitionPosting::create($validatedData);

        return redirect()->route('tuition_postings.index')->with('success', 'Tuition posting created successfully.');
    }

    public function edit(TuitionPosting $tuitionPosting)
    {
        $this->authorize('update', $tuitionPosting);
        $schoolLevels = SchoolLevel::all();
        return view('tuition_postings.edit', compact('tuitionPosting', 'schoolLevels'));
    }

    public function update(Request $request, TuitionPosting $tuitionPosting)
    {
        $this->authorize('update', $tuitionPosting);

        $validatedData = $request->validate([
            'school_level_id' => 'required|exists:school_levels,id',
            'subject' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
            'max_students' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tuition_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $tuitionPosting->update($validatedData);

        return redirect()->route('tuition_postings.index')->with('success', 'Tuition posting updated successfully.');
    }
}

