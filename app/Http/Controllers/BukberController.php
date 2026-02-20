<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class BukberController extends Controller
{
    public function index()
    {
        return view('invitation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        Attendance::create($request->all());
        return back()->with('success', 'Konfirmasi kamu sudah terkirim! See you!');
    }

    public function admin()
    {
        $data = Attendance::latest()->get();
        return view('admin', compact('data'));
    }
}
