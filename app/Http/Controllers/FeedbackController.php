<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display the feedback page.
     */
    public function index()
    {
        //
    }

    /**
     * Store a new feedback.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        try {
            $feedback = Feedback::create([
                'user_id' => Auth::id(),
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
            ]);

            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Sorry, there was an error submitting your feedback. Please try again.');
        }
    }
    
} 