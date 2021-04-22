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
}
