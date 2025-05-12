<?php

namespace App\Http\Controllers;

use App\Models\WishlistItem;
use Illuminate\Http\Request;

class WishlistItemController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->wishlistItems;
    }

    public function store(Request $request)
    {
        $request->validate([
            'wishText' => 'required|string|max:255',
            'isComplete' => 'boolean'
        ]);

        $wishlistItem = $request->user()->wishlistItems()->create([
            'wishText' => $request->wishText,
            'isComplete' => $request->isComplete ?? false
        ]);

        return response()->json($wishlistItem, 201);
    }

    public function show(Request $request, WishlistItem $wishlistItem)
    {
        $this->authorize('view', $wishlistItem);
        return $wishlistItem;
    }

    public function update(Request $request, WishlistItem $wishlistItem)
    {
        $this->authorize('update', $wishlistItem);

        $request->validate([
            'wishText' => 'string|max:255',
            'isComplete' => 'boolean'
        ]);

        $wishlistItem->update($request->only(['wishText', 'isComplete']));

        return response()->json($wishlistItem);
    }

    public function destroy(Request $request, WishlistItem $wishlistItem)
    {
        $this->authorize('delete', $wishlistItem);
        $wishlistItem->delete();
        return response()->json(null, 204);
    }
}
