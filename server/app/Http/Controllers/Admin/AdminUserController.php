<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function allAdminRole()
    {
        if (auth()->user()->adminuserrole == 1) {
            $adminUsers = User::where('type', 2)->latest()->get();

            return view('admin.role.admin_role_all', compact('adminUsers'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function addAdminRole()
    {
        if (auth()->user()->adminuserrole == 1) {

            return view('admin.role.admin_role_create');
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function storeAdminRole(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|unique:users',
            'password' => 'required',
            'profile_photo_path' => 'nullable|mimes:jpg,jpeg,png',
        ], [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'password.required' => 'パスワードを設定してください。',
            'profile_photo_path.mimes' => '画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。',
        ]);

        if ($request->has('profile_photo_path')) {

            $fileName = $this->saveImage($request->file('profile_photo_path'));

            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'admin',
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'profile_photo_path' => $fileName,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => '管理者を追加しました。',
                'alert-type' => 'success',
            );

            return redirect()->route('all.admin.user')
                ->with($notification);
        } else {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'admin',
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => '管理者を追加しました。',
                'alert-type' => 'success',
            );

            return redirect()->route('all.admin.user')
                ->with($notification);
        }
    }

    public function editAdminRole($id)
    {
        if (auth()->user()->adminuserrole == 1) {
            $adminUser = User::findOrFail($id);

            return view('admin.role.admin_role_edit', compact('adminUser'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function updateAdminRole(Request $request, $id)
    {
        $adminUser = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'profile_photo_path' => 'nullable|mimes:jpg,jpeg,png',
        ], [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'profile_photo_path.mimes' => '画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。',
        ]);

        if ($request->has('profile_photo_path')) {
            Storage::disk('s3')->delete('/admin-profile/' . $adminUser->profile_photo_path);
            $adminUser->delete();
            $fileName = $this->saveImage($request->file('profile_photo_path'));
            $adminUser->profile_photo_path = $fileName;
        }

        $adminUser->name = $request->name;
        $adminUser->email = $request->email;
        $adminUser->phone = $request->phone;
        $adminUser->role = 'admin';
        $adminUser->brand = $request->brand;
        $adminUser->category = $request->category;
        $adminUser->product = $request->product;
        $adminUser->slider = $request->slider;
        $adminUser->coupons = $request->coupons;
        $adminUser->shipping = $request->shipping;
        $adminUser->blog = $request->blog;
        $adminUser->setting = $request->setting;
        $adminUser->returnorder = $request->returnorder;
        $adminUser->review = $request->review;
        $adminUser->orders = $request->orders;
        $adminUser->stock = $request->stock;
        $adminUser->reports = $request->reports;
        $adminUser->alluser = $request->alluser;
        $adminUser->adminuserrole = $request->adminuserrole;
        $adminUser->type = 2;
        $adminUser->updated_at = Carbon::now();
        $adminUser->save();

        $notification = array(
            'message' => '管理者ID：' . $adminUser->id . 'を更新しました。',
            'alert-type' => 'info',
        );

        return redirect()->route('all.admin.user')
            ->with($notification);
    }

    public function deleteAdminRole($id)
    {
        if (auth()->user()->adminuserrole == 1) {
            $adminUser = User::findOrFail($id);
            Storage::disk('s3')->delete('/admin-profile/' . $adminUser->profile_photo_path);
            $adminUser->delete();

            $notification = array(
                'message' => '管理者：' . $adminUser->name . 'さんを削除しました。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(225, 225)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('admin-profile', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
