<?php

namespace App\Http\Controllers\Guest;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogueController extends Controller
{
    
    public function welcome()
    {
        $cards = Card::paginate(4);
        return view('pages.guest.welcome', [
            'cards' => $cards
        ]);
    }

    public function catalogue()
    {
        $cards = Card::paginate(6);
        return view('pages.guest.catalogue.index', [
            'cards' => $cards
        ]);
    }

    public function show($cardID)
    {
        $card = Card::find($cardID);
        return view('pages.guest.catalogue.show', [
            'card' => $card
        ]);
        $image = $card->image_url;
        return view('pages.guest.catalogue.show', [
            'card' => $card,
            'image' => $image
        ]);
        
    }
    public function update(Request $request, string $id)
{
    // Find the card by ID
    $card = Card::findOrFail($id);

    // Validate the form input
    $request->validate([
        'card_name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'set_code' => 'required',
        'series' => 'required',
        'rarity' => 'required',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional for update
    ]);

    // Check if the request has an image file
    if ($request->hasFile('image_url')) {
        // Delete the old image from the storage if it exists
        if ($card->image_url && file_exists(public_path('img/card/' . basename($card->image_url)))) {
            unlink(public_path('img/card/' . basename($card->image_url)));
        }

        // Store the new image in the storage/app/public/img/card directory
        $image = $request->file('image_url');
        $image_name = time() . '-' . $image->getClientOriginalName(); // Create a unique image name
        $image->storeAs('img/card', $image_name, ['disk' => 'public']); // Move the image to the storage/app/public/img/card folder

        // Update the image URL in the database (just save the path relative to the public folder)
        $card->image_url = 'img/card/' . $image_name;
    }

    // Update the card with other details
    $card->update([
        'card_name' => $request->input('card_name'),
        'price' => $request->input('price'),
        'stock' => $request->input('stock'),
        'set_code' => $request->input('set_code'),
        'series' => $request->input('series'),
        'rarity' => $request->input('rarity'),
    ]);

    return redirect()->route('guest.catalogue.index')->with('success', 'Card updated successfully');
}

public function filterBySeries($series)
{
    $cards = Card::where('series', $series)
        ->paginate(4);
    
    return view('pages.guest.catalogue.index', compact('cards'));
}
}
