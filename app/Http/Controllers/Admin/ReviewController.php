<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // !! PERBAIKAN VALIDASI !!
        $validated = $request->validate([
            'reviewer_name' => 'required|array',
            'reviewer_name.en' => 'required|string|max:255',
            'reviewer_name.nl' => 'nullable|string|max:255',
            'reviewer_name.zh' => 'nullable|string|max:255',

            'review_text' => 'required|array',
            'review_text.en' => 'required|string',
            'review_text.nl' => 'nullable|string',
            'review_text.zh' => 'nullable|string',

            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Spatie akan otomatis handle $validated['reviewer_name'] dan $validated['review_text']
        Review::create($validated);

        return redirect()->route('admin.reviews.index')
                         ->with('success', 'Review created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
         // !! PERBAIKAN VALIDASI !!
         $validated = $request->validate([
            'reviewer_name' => 'required|array',
            'reviewer_name.en' => 'required|string|max:255',
            'reviewer_name.nl' => 'nullable|string|max:255',
            'reviewer_name.zh' => 'nullable|string|max:255',

            'review_text' => 'required|array',
            'review_text.en' => 'required|string',
            'review_text.nl' => 'nullable|string',
            'review_text.zh' => 'nullable|string',

            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update($validated);

        return redirect()->route('admin.reviews.index')
                         ->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
                         ->with('success', 'Review deleted successfully.');
    }
}