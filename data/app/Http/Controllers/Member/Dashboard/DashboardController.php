<?php

namespace App\Http\Controllers\Member\Dashboard;

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
        $userId    = Auth::id();

        $totalShortUrls = ShortUrl::where('company_id', $companyId)
            ->where('created_by', $userId)
            ->count();

        $totalClicks = ShortUrl::where('company_id', $companyId)
            ->where('created_by', $userId)
            ->sum('clicks');

        $totalInvitations = Invitation::where('company_id', $companyId)
            ->where('invited_by', $userId)
            ->count();

        $pendingInvitations = Invitation::where('company_id', $companyId)
            ->where('invited_by', $userId)
            ->whereNull('accepted_at')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->where('status', '!=', 'Cancelled')
            ->count();

        $recentShortUrls = ShortUrl::where('company_id', $companyId)
            ->where('created_by', $userId)
            ->latest()
            ->take(5)
            ->get();

        $recentInvitations = Invitation::with('company')
            ->where('company_id', $companyId)
            ->where('invited_by', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('member.pages.dashboard.index', compact(
            'totalShortUrls',
            'totalClicks',
            'totalInvitations',
            'pendingInvitations',
            'recentShortUrls',
            'recentInvitations'
        ));
    }
}