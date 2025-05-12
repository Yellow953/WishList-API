<?php

namespace App\Providers;

use App\Models\WishlistItem;
use App\Policies\WishlistItemPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        WishlistItem::class => WishlistItemPolicy::class,
    ];
}
