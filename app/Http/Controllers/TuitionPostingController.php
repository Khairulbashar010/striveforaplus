<?php

namespace App\Http\Controllers;

use App\Models\TuitionPosting;
use App\Models\SchoolLevel;
use Illuminate\Http\Request;

class TuitionPostingController extends Controller
{
    public function index(Request $request)
    {
        $query = TuitionPosting::with(['user', 'schoolLevel']);
    
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('subject', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }
    
        if ($request->filled('school_level') && is_numeric($request->get('school_level'))) {
            $query->where('school_level_id', intval($request->get('school_level')));
        }
    
            if ($request->get('sort') === 'price_low_high') {
                $query->orderBy('fee', 'asc');
            } elseif ($request->get('sort') === 'price_high_low') {
                $query->orderBy('fee', 'desc');
            } else {
                $query->latest();
            }
    
        $postings = $query->paginate(6)->appends($request->query());
        $schoolLevels = SchoolLevel::all();
    
        return view('pages.home', compact('postings', 'schoolLevels'));
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

        return redirect()->route('home')->with('success', 'Tuition posting created successfully.');
    }

    public function show(TuitionPosting $tuition)
    {
        return view('tuition_postings.show', compact('tuition'));
    }

    public function edit(TuitionPosting $tuitionPosting)
    {
        if (auth()->id() !== $tuitionPosting->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        $schoolLevels = SchoolLevel::all();
        return view('tuition_postings.edit', compact('tuitionPosting', 'schoolLevels'));
    }

    public function update(Request $request, TuitionPosting $tuitionPosting)
    {
        if (auth()->id() !== $tuitionPosting->user_id) {
            abort(403, 'This action is unauthorized.');
        }
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

        return redirect()->route('home')->with('success', 'Tuition posting updated successfully.');
    }

    public function destroy(TuitionPosting $tuitionPosting)
    {
        if (auth()->id() !== $tuitionPosting->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        $tuitionPosting->delete();

        return redirect()->route('home')->with('success', 'Tuition posting deleted successfully.');
    }
}
