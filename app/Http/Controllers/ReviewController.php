<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        $reviews = Review::latest()->paginate(100);
        
        return view('admin.review.index', compact('reviews'));
    }
    
     public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'product_title' => 'required',
            'product_url' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:2000',
        ]);

        Review::create([
            'username' => Auth::user()->name,
            'email' => Auth::user()->email,
            'user_image' => Auth::user()->user_image ?? null,
            'product_id' => $request->product_id,
            'product_title' => $request->product_title,
            'product_url' => $request->product_url,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Your review has been submitted successfully!');
    }
    
    public function show($id){
        $review = Review::findOrFail($id);
        
        return view('admin.review.show', compact('review'));
    }
    
    // This is for admin dashboard.
    public function update(Request $request, $id){
        $request->validate([
            'reply' => 'required|string'  
        ]);
        
        $review = Review::findOrFail($id);
        
        $review->update([
            'reply_admin_name' => $request->reply_admin_name,
            'reply' => $request->reply
        ]);
        
        return redirect()->route('review.index')->with('success', 'Review reply send successfully.');
    }
    
    // Admin edit page 
    public function edit($id){
        $review = Review::findOrFail($id);
        
        return view('admin.review.edit', compact('review'));
    }
    
    public function destroy($id){
        $review = Review::findOrFail($id);
        
        if($review){
            $review->delete();
            return redirect()->back()->with('success', 'Review deleted successfully.');
        }
        
        return redirect()->back()->with('error', 'Review not found.');
    }
    
    public function deleteSelected(Request $request){
        $ids = $request->input('ids');
        
        if (empty($ids)) {
            return redirect()->route('review.index')
                ->with('error', 'Please select at least one review to delete.');
        }
        
        // Delete from database
        Review::whereIn('id', $ids)->delete();
        
        return redirect()->route('review.index')
            ->with('success', 'Selected Reviews Deleted Successfully!');
    }
    
    public function reviewSearch(Request $request){
        $q = trim($request->input('q', ''));
        
        if($q === ''){
            return redirect()->back()->with('error', 'Write something in search box.');
        }
        
        $reviews = Review::query()
        ->where('username', 'LIKE', "%{$q}%")
        ->orWhere('email', 'LIKE', "%{$q}%")
        ->orWhere('product_title', 'LIKE', "%{$q}%")
        ->orWhere('rating', 'LIKE', "%{$q}%")
        ->latest()
        ->paginate(100)
        ->appends(['q' => $q]);
        
        return view('admin.review.search', compact('reviews', 'q'));
    }
}
