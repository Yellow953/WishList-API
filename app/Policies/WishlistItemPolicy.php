<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WishlistItem;

class WishlistItemPolicy
{
    public function view(User $user, WishlistItem $wishlistItem)
    {
        return $user->id === $wishlistItem->user_id;
    }

    public function update(User $user, WishlistItem $wishlistItem)
    {
        return $user->id === $wishlistItem->user_id;
    }

    public function delete(User $user, WishlistItem $wishlistItem)
    {
        return $user->id === $wishlistItem->user_id;
    }
}
