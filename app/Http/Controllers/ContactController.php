<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function complete()
    {
        return view('contact.complete');
    }

    public function sendMail(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'regex:/^[0-9\-]+$/'],
            'content' => ['required', 'string', 'max:2000'],
        ]);

        Log::debug($validated['name'].'さんよりお問い合わせがありました');
        FacadesSession::flash('success-message', '作成に成功しました');

        return to_route('contact.complete');
    }
}
