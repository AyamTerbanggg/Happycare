<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\CustomEmail;


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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null, // Pastikan email belum terverifikasi
        ]);

        // Kirim email verifikasi
        $this->sendVerificationEmail($user);

        event(new Registered($user));

        Auth::login(user: $user);

        return redirect()->route('verification.notice')
        ->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi akun.');
    }

    /**
     * Send verification email to user
     */
    private function sendVerificationEmail(User $user): void
    {
        try {
            $verificationUrl = route('verification.verify', [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]);

            $emailData = [
                'subject' => 'Verifikasi Email Akun Anda',
                'message' => view('emails.verification', [
                    'user' => $user,
                    'verificationUrl' => $verificationUrl
                ])->render(),
                'template_id' => null
            ];

            // Kirim email menggunakan sistem email server
            Mail::to($user->email)->send(new CustomEmail(
                $emailData['subject'],
                $emailData['message'],
                $emailData['template_id']
            ));

        } catch (\Exception $e) {
            // Log error jika email gagal dikirim
            \Log::error('Failed to send verification email: ' . $e->getMessage());
        }
    }

    /**
     * Verify email address
     */
    public function verify(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (!hash_equals(sha1($user->email), $request->hash)) {
            return redirect()->route('login')
                ->with('error', 'Link verifikasi tidak valid.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('info', 'Email sudah terverifikasi.');
        }

        $user->markEmailAsVerified();

        return redirect()->route('login')
            ->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }

    /**
     * Resend verification email
     */
    public function resend(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Email tidak ditemukan.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->back()
                ->with('info', 'Email sudah terverifikasi.');
        }

        $this->sendVerificationEmail($user);

        return redirect()->back()
            ->with('success', 'Email verifikasi telah dikirim ulang.');
    }
} 