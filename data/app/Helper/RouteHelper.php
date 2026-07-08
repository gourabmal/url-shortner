<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('dashboardRoute')) {
    function dashboardRoute()
    {
        $user = Auth::user();

        if ($user->hasRole('SuperAdmin')) {
            return route('superadmin.dashboard');
        }

        if ($user->hasRole('Admin')) {
            return route('admin.dashboard');
        }
         if ($user->hasRole('Member')) {
            return route('member.dashboard');
        }

        return '#';
    }
}

if (!function_exists('profileRoute')) {
    function profileRoute()
    {
        $user = Auth::user();

        if ($user->hasRole('SuperAdmin')) {
            return route('superadmin.profile', $user->id);
        }

        if ($user->hasRole('Admin')) {
            return route('admin.profile', $user->id);
        }
        if ($user->hasRole('Member')) {
            return route('member.profile', $user->id);
        }

        return '#';
    }
}

if (!function_exists('invitationRoute')) {
    function invitationRoute()
    {
        $user = auth()->user();

        if ($user->hasRole('SuperAdmin')) {
            return route('superadmin.invitations.index');
        }

        if ($user->hasRole('Admin')) {
            return route('admin.invitations.index');
        }

        return '#';
    }
}

if (!function_exists('shortUrlRoute')) {
    function shortUrlRoute()
    {
        $user = auth()->user();

        if ($user->hasRole('SuperAdmin')) {
            return route('superadmin.short-urls.index');
        }

        if ($user->hasRole('Admin')) {
            return route('admin.short-urls.index');
        }
        if ($user->hasRole('Member')) {
            return route('member.short-urls.index');
        }

        return '#';
    }
}