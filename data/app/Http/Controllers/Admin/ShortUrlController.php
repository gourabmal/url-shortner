<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use App\Services\ShortUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    protected ShortUrlService $shortUrlService;

    public function __construct(ShortUrlService $shortUrlService)
    {
        $this->shortUrlService = $shortUrlService;
    }

    /**
     * Display all short URLs.
     */
    public function index()
    {
        $shortUrls = ShortUrl::with(['company', 'creator'])
            ->where('company_id', Auth::user()->company_id)
            ->latest()
            ->paginate(15);

        return view('admin.short_urls.index', compact('shortUrls'));
    }

    /**
     * Show create page.
     */
    public function create()
    {
        return view('admin.short_urls.create');
    }

    /**
     * Store a newly generated short URL.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_url' => ['required', 'url'],
        ]);

        // Create with a temporary code
        $shortUrl = ShortUrl::create([
            'company_id'      => Auth::user()->company_id,
            'created_by'      => Auth::id(),
            'destination_url' => $validated['destination_url'],
            'code'            => 'temp', // temporary value
            'clicks'          => 0,
            'is_active'       => 1,
        ]);

        // Generate the final code using the ID
        $shortUrl->code = $this->shortUrlService->generateCode($shortUrl->id);
        $shortUrl->save();

        return redirect()
            ->route('admin.short-urls.index')
            ->with('success', 'Short URL generated successfully.');
    }
}
