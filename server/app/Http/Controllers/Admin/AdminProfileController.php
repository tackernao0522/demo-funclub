<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function adminProfileEdit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function adminProfileStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'phone' => 'string|nullable',
            'profile_photo_path' => 'mimes:jpg,jpeg,png|nullable',
        ], [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'profile_photo_path.mimes' => 'プロフィール画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->updated_at = Carbon::now();

        if ($request->has('profile_photo_path')) {
            Storage::disk('s3')->delete('/admin-profile/' . $data->profile_photo_path);
            $data->delete();
            $fileName = $this->saveImage($request->file('profile_photo_path'));
            $data['profile_photo_path'] = $fileName;
        }

        $data->save();

        $notification = array(
            'message' => '管理者プロフィールを更新しました。',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function adminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function adminUpdateChangePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required|string|min:8',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = User::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('login')->with('status', 'パスワードを更新しました。');
        } else {
            $notification = array(
                'message' => '現在のパスワードが無効です。',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function allUsers()
    {
        if (auth()->user()->alluser == 1) {
            $users = User::latest()->get();

            return view('admin.user.all_user', compact('users'));
        } else {
            $notification = array(
                'message' => '権限がありません。',
                'alert-type' => 'error',
            );

            return redirect()->back()
                ->with($notification);
        }
    }

    public function allUserDelete($id)
    {
        if (Auth::check() && Auth::user()->role === 'admin' && Auth::check() && Auth::user()->type === 1) {
            $user = User::findorFail($id);
            if ($user->role === 'premium' || $user->role === 'member') {
                Storage::disk('s3')->delete('/user-profile/' . $user->profile_photo_path);
                $user->delete();

                $notification = array(
                    'message' => 'ユーザー: ' . $user->name . 'を削除しました。',
                    'alert-type' => 'error',
                );

                return redirect()->back()
                    ->with($notification);
            } elseif ($user->type === 2) {
                Storage::disk('s3')->delete('/admin-profile/' . $user->profile_photo_path);
                $user->delete();

                $notification = array(
                    'message' => 'ユーザー: ' . $user->name . 'を削除しました。',
                    'alert-type' => 'error',
                );

                return redirect()->back()
                    ->with($notification);
            }
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

        Image::make($file)->resize(100, 100)->save($tempPath);

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
