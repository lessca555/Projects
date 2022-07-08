<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Alamat;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Alert;
use File;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        

        return view('profile.account', compact('user'));
    }

    public function edit(){
        $user = User::where('id', Auth::user()->id)->first();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $alamat = Alamat::all();

        return view('profile.edit-profile', compact('user', 'kota', 'provinsi', 'alamat'));
    }

    public function update(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $alamat = Alamat::where('id_alamat', Auth::user()->id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        if(empty($alamat)){
            $alamat = new Alamat;
            $alamat->id_alamat = "ADDR-" . Auth::user()->id;
            $alamat->alamat = $request->alamat;
            $alamat->provinsi = $request->provinsi;
            $alamat->kota = $request->kota;
            $alamat->kode_pos = $request->kode_pos;
            $alamat->save();
        }else{
            $alamat->update();
        }

        if(!empty($request_image = $request->file('avatar'))){
            $this->validate($request, [
                'avatar' => 'image|mimes:jpg,jpeg,png,gif,svg',
            ]);

            $image = Image::make($request_image);

            $image_path = public_path('pics/avatars/');

            if (!File::exists($image_path)) {
                File::makeDirectory($image_path);
            }

            $image_name = time().'.'.$request_image->getClientOriginalExtension();

            // keep ratio height and width
            $image->resize(300, 300, function($constraint) {
                $constraint->aspectRatio();
            });

            $user->avatar = $image_name;

            $image->save($image_path.$image_name);
        }
        $user->id_alamat = "ADDR-" . Auth::user()->id;
        $user->update();

        Alert::success('Profile berhasil di update');
        return redirect('profile');
    }

    public function password()
    {
        $messege = "";
        return view('profile.edit-password', compact('messege'));
    }

    public function cpassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPass = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPass)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            Alert::success('Password berhasil di update');
            return redirect()->route('login');
        }else{
            return redirect()->back()->with('error', 'Password lama salah');
        }
    }
}
