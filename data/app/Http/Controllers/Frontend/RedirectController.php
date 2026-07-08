<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;

class RedirectController extends Controller
{
    /**
     * Redirect a short URL to its destination.
     */
    public function redirect(string $code)
    {
        $shortUrl = ShortUrl::where('code', $code)
            ->where('is_active', true)
            ->first();

        if (!$shortUrl) {
            abort(404);
        }

        // Increment click count
        $shortUrl->increment('clicks');

        return redirect()->away($shortUrl->destination_url);
    }
}