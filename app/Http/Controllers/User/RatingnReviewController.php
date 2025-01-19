<?php

namespace App\Http\Controllers\User;

use App\Models\Card;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\RatingNReview;
use Illuminate\Auth\AuthManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingNReviewController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id);

        // Fetch the order
        $order = Order::find($request->order_id);

        // Check if the order exists
        if (!$order) {
            return redirect()->back()->withErrors(['error' => 'Order not found.']);
        }

        // Get the first order item
        $orderItem = $order->orderItems()->first();

        if (!$orderItem) {
            return redirect()->back()->withErrors(['error' => 'No items found in the order.']);
        }

        // Get the card from the order item's cart item
        $card = $orderItem->cartItem->card;

        if (!$card) {
            return redirect()->back()->withErrors(['error' => 'Card not found.']);
        }

        // Fetch reviews for the user
        $reviews = RatingNReview::with(['user', 'card'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('pages.user.ratingnreview.index', compact('reviews', 'card'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:cards,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500'
        ]);

        // Check if user has already reviewed this card
        $existingReview = RatingNReview::where('user_id', Auth::id())
            ->where('card_id', $request->card_id)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this card.');

        }

        RatingNReview::create([
            'user_id' => Auth::id(),
            'card_id' => $request->card_id,
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function destroy(RatingNReview $review)
    {
        if ($review->user_id !== User::find(auth()->user->id)->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }

    public function showModal($cardId)
    {
        $card = Card::findOrFail($cardId);
        $user = Auth::user();
        $reviews = RatingNReview::with('user')
            ->where('card_id', $cardId)
            ->latest()
            ->get();

        $averageRating = RatingNReview::where('card_id', $cardId)->avg('rating') ?? 0;
        $reviewCount = RatingNReview::where('card_id', $cardId)->count();
        
        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = RatingNReview::where('card_id', $cardId)
                ->where('rating', $i)
                ->count();
            $percentage = $reviewCount > 0 ? ($count / $reviewCount) * 100 : 0;
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => $percentage
            ];
        }

        return view('pages.user.ratingnreview.index', compact(
            'card',
            'reviews',
            'averageRating',
            'reviewCount',
            'ratingDistribution'
        ));
    }
    public function create()

    {
        $user = User::find(Auth::user()->id);
        $rating = RatingNReview::with(['user_id', 'card_id'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('pages.user.ratingnreview.index', compact('rating'));

    }
}
