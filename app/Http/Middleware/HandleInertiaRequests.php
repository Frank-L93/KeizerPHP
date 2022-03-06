<?php

namespace App\Http\Middleware;

use App\Models\Club;
use App\Models\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Illuminate\Support\Facades\Session;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => Auth::user() ? [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'knsb_id' => Auth::user()->knsb_id,
                        'club_id' => Auth::user()->club_id,
                        'rating' => Auth::user()->rating,
                        'beschikbaar' => Auth::user()->beschikbaar,
                        'firsttimelogin' => Auth::user()->firsttimelogin,
                        'active' => Auth::user()->active,
                        'activate' => Auth::user()->activate,
                        'settings' => Auth::user()->settings(),
                        'club' => Club::where('id', Auth::user()->club_id)->first(),
                        'roles' => Auth::user()->getRoleNames(),
                    ] : null,
                ];
            },
            'clubname' => function () use ($request) {
                if (Auth::user()) {
                    return
                        Club::where('id', Auth::user()->club_id)->pluck('name');
                } else {
                    return ['KeizerPHP'];
                }
            },
            'club' => function () use ($request) {
                return [
                    'details' => Auth::user() ? [
                        'veryFirstRound' => Round::veryFirstRound(),
                        'firstRound' => Round::firstRound(),
                        'lastRound' => Round::lastRound(),
                        'lastProcessed' => Round::lastProcessedRound(),
                        'currentRound' => Round::currentRound(),
                    ] : null,
                ];
            },
            'flash' => function () use ($request) {

                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                    'status' => $request->session()->get('status'),
                ];
            },
            'route' => function () use ($request) {
                return [
                    'params' => $request->route()->parameters(),
                    'query' => $request->all(),
                ];
            },
        ]);
    }
}
