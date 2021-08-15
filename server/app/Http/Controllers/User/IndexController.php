<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class IndexController extends Controller
{
    public function userDashboard()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('user.dashboard', compact('user'));
    }

    public function userProfile()
    {
        if (Auth::check() && Auth::user()->role === 'member' || Auth::check() && Auth::user()->role === 'premium') {
            $id = Auth::user()->id;
            $user = User::find($id);

            return view('user.profile.user_profile', compact('user'));
        }
    }

    public function userProfileStore(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'member' || Auth::check() && Auth::user()->role === 'premium') {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required',
                'phone' => 'string|nullable',
                'profile_photo_path' => 'mimes:jpg,jpeg,png|nullable',
            ], [
                'name.required' => 'ユーザー名は必須です。',
                'email.required' => 'メールアドレスは必須です。',
                'profile_photo_path.mimes' => 'プロフィール画像にはjpg, jpeg, pngのうちいずれかの形式のファイルを指定してください。',
            ]);

            $data = User::find(Auth::user()->id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;

            if ($request->has('profile_photo_path')) {
                Storage::disk('s3')->delete('/user-profile/' . $data->profile_photo_path);
                $data->delete();
                $fileName = $this->saveImage($request->file('profile_photo_path'));
                $data['profile_photo_path'] = $fileName;
            }

            $data->save();

            $nofification = array(
                'message' => 'ユーザープロフィールを更新しました。',
                'alert-type' => 'success'
            );
            return redirect()->route('user.dashboard')->with($nofification);
        }
    }

    public function userChangePassword(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'member' || Auth::check() && Auth::user()->role === 'premium') {
            $id = Auth::user()->id;
            $user = User::find($id);

            return view('user.profile.change_password', compact('user'));
        }
    }

    public function userPasswordUpdate(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'member' || Auth::check() && Auth::user()->role === 'premium') {
            $this->validate($request, [
                'oldpassword' => 'required|string|min:8',
                'password' => 'required|confirmed',
            ]);

            $hashedPassword = Auth::user()->password;

            if (Hash::check($request->oldpassword, $hashedPassword)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
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
    }

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->resize(300, 300)->save($tempPath);

        $filePath = Storage::disk('s3')
            ->putFile('user-profile', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
