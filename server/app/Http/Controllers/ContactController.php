<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Contact;

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

    public function process(Request $request)
    {
        $action = $request->get('action', 'return');
        $input = $request->except('action');

        if ($action === 'submit') {
            $contact = new Contact();
            $contact->fill($input);
            $contact->save();

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
