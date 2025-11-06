<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Auth;
use File;
use Hash;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Profile";
        $user = Auth::user();
        $userDetail = Auth::user()->userDetail;
        return view('profile.index', compact('title', 'user', 'userDetail'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $user = Auth::user();
        // if the old password is different from what the user fill in

        if (!Hash::check($request->old_password, $user->password)) {
            alert()->error('Failed', 'The old password is wrong!');
            return back();
        }
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        alert()->success('Success', 'Your password has been successfully changed');
        return back();
    }

    public function changeProfile(Request $request)
    {
        $user = Auth::user();
        $photoPath = "";

        if($request->hasFile('photo')){
            $photo = $request->file('photo');

            if($user->userDetail && $user->userDetail->photo){
                File::delete(public_path('storage/' . $user->userDetail->photo));
            }
            $photoPath = $photo->store('profiles', 'public'); //storage/app/public/profiles
        }
        //upsert=jika datanya belum ada maka insert, selain update
        try {
            //code...
            UserDetail::upsert(
                [
                    //insert
                    [
                        'user_id' => $user->id,
                        'photo'=> $photoPath ?? ($user->userDetail->photo ?? ''),
                        'about' => $request->about,
                        'company' => $request->company,
                        'job' => $request->job,
                        'address' => $request->address,
                        'phone' => $request->phone,
                    ]
                ],
                //edit
                ['user_id'],
                ['photo', 'about', 'company', 'job', 'address', 'phone']

            );
            alert()->success('Success', 'Your profile has been successfully edited!');
            return redirect()->to('profile');
        } catch (\Throwable $th) {
            alert()->error('Error', $th->getMessage());
            return redirect()->to('profile');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
