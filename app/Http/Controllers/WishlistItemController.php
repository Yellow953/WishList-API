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

    public function update(Request $request, $id)
    {
        $wishlistItem = WishlistItem::findOrFail($id);

        if ($request->user()->id !== $wishlistItem->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'wishText' => 'string|max:255',
            'isComplete' => 'boolean'
        ]);

        $wishlistItem->update($request->only(['wishText', 'isComplete']));

        return response()->json(['message' => 'Wishlist Item deleted successfully'], 200);
    }

    public function destroy(Request $request, $id)
    {
        $wishlistItem = WishlistItem::findOrFail($id);

        if ($request->user()->id !== $wishlistItem->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $wishlistItem->delete();

        return response()->json(['message' => 'Wishlist Item deleted successfully'], 204);
    }
}
