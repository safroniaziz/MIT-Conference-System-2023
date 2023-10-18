<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone_number' => ['nullable', 'string', 'max:20'], // Aturan validasi untuk phone_number
            'address' => ['required', 'string'],
            'account_type' => ['required'],
            'profile_picture' => ['required', 'image', 'mimes:jpeg,png'],
        ];
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        // Hapus gambar profil lama jika ada
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        
        $request->user()->fill($request->validated());
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imagePath = $image->store('profile_pictures', 'public');
    
            // Ubah ukuran gambar jika diperlukan
            $image = Image::make(storage_path("app/public/{$imagePath}"));
            $image->fit(200, 200);
            $image->save();
            $request->user()->photo = $imagePath;
        }

        $request->user()->save();

        return Redirect::route('dashboard');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
