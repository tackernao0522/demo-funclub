<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function contactList()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return view('admin/contacts.list', ['contacts' => $contacts]);
    }

    public function contactEditForm(Contact $contact)
    {
        return view('admin/contacts.list_form', ['contact' => $contact]);
    }

    public function EditStatus(Request $request, Contact $contact)
    {
        $contact->status = $request->status;
        $contact->save();

        return redirect()->route('contact.list')
            ->with('status', '状態を更新しました。');
    }

    public function destroy(Contact $id)
    {
        $id->delete();

        return redirect()->route('contact.list')
            ->with('status', '削除しました。');
    }
}
