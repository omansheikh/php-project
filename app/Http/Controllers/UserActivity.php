<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function recentActivities()
    {
        $activities = Activity::latest()->take(10)->get(); // Fetch the latest 10 activities

        return view('activities.recent', compact('activities'));
    }
}
