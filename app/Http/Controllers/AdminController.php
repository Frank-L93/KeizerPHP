<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Presence;
use App\Models\Ranking;
use App\Models\Round;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Config;
use Inertia\Inertia;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        // Get all data for this Admin (all queries are limited to the current Club_ID)
        // Future work: Super-Admin to get more
        return Inertia::render('Admin/Index');
    }
}
