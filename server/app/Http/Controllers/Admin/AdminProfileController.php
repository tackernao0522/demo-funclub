<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }
}
