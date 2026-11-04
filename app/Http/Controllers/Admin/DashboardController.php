<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Project;
use App\Models\Stat;
use App\Models\Service;
use App\Models\Plan;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use App\Models\ProcessStep;
use App\Models\Skill;
use App\Models\Album;
use App\Models\SocialLink;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects' => Project::count(),
            'posts' => Post::count(),
            'contacts' => Contact::where('read', false)->count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();

        $notifications = auth()->user() ? auth()->user()->notifications()->take(5)->get() : collect();
        $auditLogs = \App\Models\ActivityLog::with('user')->latest()->take(7)->get();
        $loginHistories = \App\Models\LoginHistory::with('user')->latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'notifications', 'auditLogs', 'loginHistories'));
    }

    public function frontendManage(): View
    {
        $stats = [
            'stats' => Stat::count(),
            'services' => Service::count(),
            'plans' => Plan::count(),
            'testimonials' => Testimonial::count(),
            'whyChooseUs' => WhyChooseUs::count(),
            'processSteps' => ProcessStep::count(),
            'skills' => Skill::count(),
            'albums' => Album::count(),
            'socialLinks' => SocialLink::count(),
        ];

        return view('admin.frontend-manage', compact('stats'));
    }
}
