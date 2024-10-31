<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\Vision;
use App\Models\MissionCard;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $aboutContent = AboutContent::first();
        $vision = Vision::first();
        $missionCards = MissionCard::all();
        $teamMembers = TeamMember::where('is_active', true)
                                ->orderBy('display_order')
                                ->get();

        return view('about', compact(
            'aboutContent',
            'vision',
            'missionCards',
            'teamMembers'
        ));
    }
}