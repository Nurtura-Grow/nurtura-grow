<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;

use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function index(): View
    {
        return view('account.forgot-password');
    }

    public function password(Request $request)
    {
        return redirect()->route('verifikasi');
    }

    public function index_verifikasi(Request $request, $email): View
    {
        $email_decrypted = Crypt::decryptString($email);
        return view('account.verifikasi-otp', [
            'email' => $email_decrypted,
            'email_encrypted' => $email,
        ]);
    }

    public function index_reset_password(Request $request, $email): View
    {
        $email_decrypted = Crypt::decryptString($email);
        return view('account.reset-password', [
            'email' => $email_decrypted,
            'email_encrypted' => $email,
        ]);
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'string', 'email', 'max:255'],
            ],
            [
                'email.required' => 'The email field is required.',
                'email.string' => 'The email must be a string.',
                'email.email' => 'The email must be a valid email address.',
                'email.max' => 'The email may not be greater than 255 characters.',
            ]
        );

        $email =  $request['email'];

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $verify = User::where('email', $email)->exists();

        if ($verify) {
            $token = random_int(1000, 9999);
            $verify2 = PasswordResets::where('email', $email)->first();
            if ($verify2) {
                $verify2->delete();
            }

            $password_reset = PasswordResets::create([
                'email' => $email,
                'token' =>  $token,
                'created_at' => Carbon::now()
            ])->id;

            if ($password_reset) {
                Mail::to($email)->send(new ResetPassword($token));
                return redirect()->route('verifikasi', [
                    'email' => Crypt::encryptString($email)
                ]);
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Email tidak terdaftar pada sistem!']);
        }
    }

    public function verifikasi(Request $request, $email)
    {
        $email_decrypted = Crypt::decryptString($email);
        $otp_combined = $request['otp_combined'];

        $validator = Validator::make($request->all(), [
            'otp_combined' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $check = PasswordResets::where(
            'email',
            $email_decrypted
        )->where(
            'token',
            $otp_combined
        )->first();

        if ($check) {
            $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
            if ($difference > 3600) {
                return redirect()->back()->withErrors('otp_combined', 'OTP sudah kadaluarsa!');
            }

            PasswordResets::where([
                ['email', $email_decrypted],
                ['token', $otp_combined],
            ])->delete();

            return redirect()->route('reset_password', [
                'email' => Crypt::encryptString($email_decrypted)
            ]);
        } else {
            return redirect()->back()->withErrors('otp_combined', 'OTP tidak valid!');
        }
    }

    public function reset_password(Request $request, $email)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = User::where('email', $email);
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with([
            'password_reset' => 'Password Anda telah berhasil direset, silahkan login kembali dengan password baru!'
        ]);
    }
}
