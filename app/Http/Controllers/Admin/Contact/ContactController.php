<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Mail\Reply;
use App\Mail\ReplyMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\Contact\ReplyRequest;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::paginate();
        return view('admin.pages.contact.index', compact('messages'));
    }

    public function show(Contact $contact)
    {
        return view('admin.pages.contact.show', compact('contact'));
    }

    public function store(ReplyRequest $request)
    {
        $data = $request->validated();
        Mail::to($data['email'])
            ->send(new Reply($data['reply']));
        return back()
            ->with('success', 'mail sent successfully');
    }
}
