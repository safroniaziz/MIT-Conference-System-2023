<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'account_type'  =>  ['required'],
            'profile_picture' => 'required|image|mimes:jpeg,png',
        ]);

        $lastUserCode = User::max('unique_code');
        $nextUserCode = str_pad(intval($lastUserCode) + 1, 3, '0', STR_PAD_LEFT);
    

        $userAttributes = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'unique_code' => $nextUserCode,
        ];

        // Proses gambar profil
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imagePath = $image->store('profile_pictures', 'public');
    
            // Ubah ukuran gambar jika diperlukan
            $image = Image::make(storage_path("app/public/{$imagePath}"));
            $image->fit(200, 200);
            $image->save();

            $userAttributes['photo'] = $imagePath;
        }

        $user = User::create($userAttributes);

        if ($request->account_type == 'presenter') {
            $user->assignRole('presenter');
        } elseif ($request->account_type == 'participant') {
            $user->assignRole('participant');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
