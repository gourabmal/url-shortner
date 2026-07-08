<?php

namespace App\Http\Controllers\SuperAdmin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Invitation;
use App\Models\ShortUrl;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalCompanies = Company::count();

        $totalShortUrls = ShortUrl::count();

        $totalClicks = ShortUrl::sum('clicks');

        $totalInvitations = Invitation::count();

        $pendingInvitations = Invitation::whereNull('accepted_at')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->where('status', '!=', 'Cancelled')
            ->count();

        $recentShortUrls = ShortUrl::with(['company', 'creator'])
            ->latest()
            ->take(5)
            ->get();

        $recentInvitations = Invitation::with(['company', 'inviter'])
            ->latest()
            ->take(5)
            ->get();

        return view('super_admin.pages.dashboard.index', compact(
            'totalCompanies',
            'totalShortUrls',
            'totalClicks',
            'totalInvitations',
            'pendingInvitations',
            'recentShortUrls',
            'recentInvitations'
        ));
    }
}