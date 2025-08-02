<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View|\Illuminate\Http\RedirectResponse
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'غير مصرح لك بعرض هذه الصفحة.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|max:20',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'grade' => 'required|string|max:255',
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'phone' => $request->phone,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'grade' => $request->grade,
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(route('lessons.index', absolute: false));
    }
}
