<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\RegisterUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\RegisterUserToOwner;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller {

    //REGISTER METHOD
    public function register(Request $request, User $user) {
        $incomingFields = $request->validate([
            "name" => "required|min:4",
            "email" => [Rule::unique('users', 'email')->ignore($user->id), "required"],
            "address" => "required",
            "city" => "required",
            "zip" => "required",
            "phone" => "required",
            "password" => "required|min:4",
            "confirm-password" => "required|min:4|same:password"
        ]);


        $incomingFields["verification_code"] = Str::random(14);
        $incomingFields['name'] = Str::title($incomingFields['name']);
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = new User($incomingFields);
        $user->save();

        Mail::to($incomingFields['email'])->send(new RegisterUser($user));
        Mail::to($incomingFields['email'])->send(new EmailVerificationMail($user));
        Mail::to("neil.mallia1@gmail.com")->send(new RegisterUserToOwner($user));
        // event(new Registered($user));

        if ($user) {
            auth()->login($user);
            return redirect('/menu1')->with('success', "Your about to experience something great! Please Verify Your Email!");
        } else {
            redirect('/login')->with('failure', 'something went wrong');
        }
    }

    public function getLoginPage() {
        if (!Auth::check()) {
            return view("login");
        } else {
            return view("menu1");
        }
    }




    public function login(Request $request) {
        $incomingFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if (auth()->attempt([
            'email' => $incomingFields['email'],
            'password' => $incomingFields['password']
        ])) {
            $request->session()->regenerate();

            if (Session::has('previous_url')) {
                $previousUrl = Session::get('previous_url');
                Session::forget('previous_url');
                return redirect($previousUrl)->with('success', 'Logged in successfully.');
            } else {
                return redirect()->back()->with('success', 'Logged in successfully.');
            }
        } else {
            return redirect()->back()->with('failure', 'Invalid login credentials.');
        }
    }



    //LOGOUT METHOD
    public function logout() {
        auth()->logout();
        return redirect('/profile')->with("success", "You successfully logged out");
    }


    //Update profile Method
    public function updateProfile(Request $request, User $user, $id) {
        $user = User::findOrFail($id);

        $incomingFields = $request->validate([
            "name" => "min:4|nullable",
            "email" => [Rule::unique("users", "email")->ignore($user->id), "nullable"],
            "phone" => "min:5|nullable",
            "zip" => "min:3|nullable",
            "address" => "min:5|nullable",
            "city" => "min:3|nullable"
        ]);
        //check if fields are filled, if not give them the previous value
        $fillableFields = ['name', 'email', 'phone', 'zip', 'address', 'city'];
        foreach ($fillableFields as $field) {
            if (!isset($incomingFields[$field])) {
                $incomingFields[$field] = $user->$field;
            }
        }

        $user->update($incomingFields);
        return redirect()->back()->with("success", "Profile Updated");
    }

    //Change Password Method
    public function updatePassword(Request $request, User $user) {

        $incomingFields = $request->validate([
            "currentPassword" => "required",
            "newPassword" => "required",
            "confirmNewPassword" => "required|same:newPassword"
        ]);

        $user = Auth::user();

        if (Hash::check($incomingFields['currentPassword'], $user->password)) {
            if (Hash::check($incomingFields['newPassword'], $user->password)) {
                return redirect()->back()->withErrors(['newPassword' => 'New password should be different from the current password.']);
            }
            $user->password = Hash::make($request->newPassword);
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully.');
        }
        return redirect()->back()->with('failure', 'Invalid Password!');
    }

    public function getAllActiveUsers() {
        $activeUsers = User::where("active", "!=", "false")->get();
        $userRole = Auth::guard("staff")->user()->Role;
        return view("restaurant", compact("activeUsers", "userRole"));
    }

    public function getAllInactiveUsers() {
        $inactiveUsers = User::where("active", "=", "false")->get();
        $userRole = Auth::guard("staff")->user()->Role;
        return view("restaurant", compact("inactiveUsers", "userRole"));
    }

    public function getUserToEdit($id) {
        $user = User::find($id);
        return view("updateUser", compact("user"));
    }

    public function getUserToDelete($id) {
        $user = User::find($id);
        return view("deleteUser", compact("user"));
    }

    public function deleteProfile($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect("/restaurant/staff/active")->with("success", "User Deleted");
    }
    //Manager deactiving account of user
    public function deactivateAccount($id) {
        $user = User::find($id);
        $user->active = false;
        $user->save();
        return redirect("/restaurant/users/inactive")->with("success", $user->name . "'s Account Deactivated Successfully");
    }

    //Manager activing account of user
    public function activateAccount($id) {
        $user = User::find($id);
        $user->active = true;
        $user->save();
        return redirect("/restaurant/users/active")->with("success", $user->name . "'s Account Activated Successfully");
    }
    //deactivate own account
    public function deactivateAccountAsUser($id) {
        $user = User::find($id);
        $user->active = false;
        $user->save();
        return redirect("/profile/settings")->with("success", "Your Account Has Been Deactivated Successfully");
    }
    //active own account
    public function activateAccountAsUser($id) {
        $user = User::find($id);
        $user->active = true;
        $user->save();
        return redirect("/profile/settings")->with("success", "Your Account Has Been Activated Successfully");
    }

    public function show($id) {
        $users = User::find($id);
        return response()->json($users);
    }


    //Forgot Password Method


    //Check if the email is avaliable AJAX
    public function checkEmailAvailability(Request $request) {
        $email = $request->input('email');
        // Check if a user with the given email already exists in the database
        $emailExists = User::where('email', $email)->exists();
        return response()->json(['available' => !$emailExists]);
    }




    public function verifyEmail($code) {
        $user = User::where("verification_code", $code)->first();
        if (!$user) {
            return redirect("/profile")->with("failure", "Invalid URL");
        } else {
            if ($user->email_verified_at != null) {
                return redirect("/profile/settings")->with("success",  "Email Already Verified");
            } else {
                $user->update([
                    "email_verified_at" => Carbon::now()
                ]);
                return redirect("/profile/settings")->with("success", "Email Verified Successfully");
            }
        }
    }


    public function resendCode($id) {
        $user = User::where("id", $id)->first();
        $isUserVerified = $user->email_verified_at;
        if (!$isUserVerified) {
            Mail::to($user->email)->send(new EmailVerificationMail($user));
            return redirect()->back()->with("resent", "An email with the verification link has been sent to your email");
        } else {
            return redirect("/profile/settings")->with("failure", "Email already verified");
        }
    }


    public function changeProfilePicture($id) {
        $user = User::where("id", $id)->first();
        $profilePicture = $user->profile_picture;
        return view("change-profile-picture", compact("profilePicture"));
    }

    public function changeThePicture(Request $request) {
        $incomingFields = $request->validate([
            "image" => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        $image = $request->file('image');
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Store the image in the storage/app/public/images directory
        $path = $image->storeAs('public/images', $fileName);

        // Remove "public/" from the stored path
        $storedPath = str_replace('public/', '', $path);

        $input['image'] = '/storage/' . $storedPath;

        $user = Auth::user();

        // Delete the previous profile picture if it exists
        if ($user->profile_picture) {
            Storage::delete('public' . substr($user->profile_picture, 8));
        }

        $user->profile_picture = $input['image'];
        $user->save();

        return redirect()->back()->with("success", "Profile Picture Changed");
    }
}
