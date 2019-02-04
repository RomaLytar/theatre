<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    public function index() {
        $donations = Donation::latest()->paginate(30);

        return view('admin.donations.index', compact('donations'));
    }
}
