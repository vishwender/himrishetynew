<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function terms_conditions()
    {
        $page = Page::first();
        return view('dashboard.terms', compact('page'));
    }
    public function privacy_policy()
    {
        $page = Page::first();
        return view('dashboard.privacy', compact('page'));
    }
    public function refund()
    {
        $page = Page::first();
        return view('dashboard.refund', compact('page'));
    }
}
