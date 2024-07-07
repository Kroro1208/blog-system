<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact.index');
    }

    public function complete(): View
    {
        return view('contact.complete');
    }

    public function sendMail(ContactRequest $request): RedirectResponse
    {

        $validated = $request->validated();

        Log::debug($validated['name'] . 'さんよりお問い合わせがありました');
        FacadesSession::flash('success-message', '作成に成功しました');

        return to_route('contact.complete');
    }
}
