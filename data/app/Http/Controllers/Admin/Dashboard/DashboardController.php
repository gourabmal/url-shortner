<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $companyId = Auth::user()->company_id;

        $totalShortUrls = ShortUrl::where('company_id', $companyId)->count();

        $totalClicks = ShortUrl::where('company_id', $companyId)->sum('clicks');

        $totalInvitations = Invitation::where('company_id', $companyId)->count();

        $pendingInvitations = Invitation::where('company_id', $companyId)
            ->whereNull('accepted_at')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->where('status', '!=', 'Cancelled')
            ->count();

        $recentShortUrls = ShortUrl::with(['company', 'creator'])
            ->where('company_id', $companyId)
            ->latest()
            ->take(5)
            ->get();

        $recentInvitations = Invitation::with('company')
            ->where('company_id', $companyId)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.pages.dashboard.index', compact(
            'totalShortUrls',
            'totalClicks',
            'totalInvitations',
            'pendingInvitations',
            'recentShortUrls',
            'recentInvitations'
        ));
    }
}