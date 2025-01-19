<?php

namespace App\Http\Controllers\Seller;

use App\Models\Card;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    public function index()
    {
        $cards = Card::orderBy('created_at', 'desc')->paginate(10);
                 
        return view('pages.seller.catalogue.index', compact('cards'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $cards = Card::where('card_name', 'like', '%' . $search . '%')->paginate(3);
        return view('pages.seller.catalogue.index', [
            'cards' => $cards
        ]);
    }   

    public function create()
    {
        return view('pages.seller.catalogue.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'rarity' => 'required',
            'set_code' => 'required',
            'series' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('img/card', 'public');

        Card::create([
            'card_name' => $request->input('card_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'rarity' => $request->input('rarity'),
            'set_code' => $request->input('set_code'),
            'series' => $request->input('series'),
            'description' => $request->input('description'),
            'image' => $path,
        ]);
        return redirect()->route('seller.catalogue.index')->with('success', 'Card created successfully');
    }

    public function show(string $id)
    {
        $card = Card::findOrFail($id);
        return view('pages.seller.catalogue.show', compact('card'));
    }

    public function edit(Card $card)
    {
        return view('pages.seller.catalogue.edit', compact('card'));
    }

    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'card_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'rarity' => 'required|string|max:255',
            'set_code' => 'required|string|max:255',
            'series' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($card->image && Storage::disk('public')->exists($card->image)) {
                Storage::disk('public')->delete($card->image);
            }
            $imagePath = $request->file('image')->store('img/card', 'public');
            $validated['image'] = $imagePath;
        }

        $card->update($validated);

        return redirect()->route('seller.catalogue.index')
            ->with('success', 'Card updated successfully');
    }

    public function destroy(string $id)
    {
        $card = Card::findOrFail($id);
        $card->delete();
        return redirect()->route('seller.catalogue.index')->with('success', 'Card deleted successfully');
    }
}


