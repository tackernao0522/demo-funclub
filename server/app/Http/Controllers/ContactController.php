<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactShowForm()
    {
        return view('contact.contact_form');
    }
}