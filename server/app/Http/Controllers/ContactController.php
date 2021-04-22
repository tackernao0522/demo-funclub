<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use App\Contact;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function contactShowForm()
    {
        return view('contact.contact_form');
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();

        return view('contact.confirm', ['inputs' => $inputs]);
    }

    public function process(ContactRequest $request)
    {
        $action = $request->get('action', 'return');
        $input = $request->except('action');

        if ($action === 'submit') {
            $contact = new Contact();
            $contact->fill($input);
            $contact->save();

            Mail::to($input['your_email'])->send(new ContactMail('mails.contact', 'お問い合わせありがとうございます', $input));

            return redirect()->route('complete');
        } else {
            return redirect()->route('contact.form')->withInput($input);
        }
    }

    public function complete()
    {
        return view('contact.complete');
    }
}
