<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'apikey' => str_random(35) . time(),
        ]);
    }

    public function logout(Request $request) {
        // auth()->user()->tokens->each(function($token, $key) {
        //     $token->delete();
        // });
        $request->user()->token()->delete();

        return response()->json('Logged out succesfully', 200);
    }

    public function forgotPassword(Request $request) {
        $user = User::where('email', $request->email)->get();
        $user[0]->update([
            'reset_password_token' => str_random(45) . time(),
        ]);
        $to      = $request->email;
        $subject = 'Reset password on your SiteRocket account';
        $message = "
        <!DOCTYPE html>
        <html lang='en' dir='ltr'>
            <head>
                <meta charset='utf-8'>
                <title></title>
            </head>
            <body bgcolor='#cecece' style='backround-color: #cecece;'>
                <center>
                    <table bgcolor='#cecece' width='100%' height='100%'>
                        <tr style='height: 60px;'>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <center>
                                <table cellspacing='0' width='100%' style='max-width: 540px; font-family: Arial, Helvetica, sans-serif;'>
                                    <tr bgcolor='#5D7A82' height='120px'>
                                        <td width='20%'></td>
                                        <td width='60%'><img src='http://assets.sovid.dk/siterocket_logo.png'></td>
                                        <td width='20%'></td>
                                    </tr>
                                    <tr bgcolor='#ffffff' style='backround-color: #ffffff; height: 60px;'>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr bgcolor='#ffffff' style='backround-color: #ffffff;'>
                                        <td></td>
                                        <td>Hello<br><br>You have requested to have your password reset on your SiteRocket account linked to " . $request->email . ".<br><br>
                                          The link to reset the password for your account is:<br>"
                                        . $request->frontendUrl  .
                                        "/" . "reset/" . $request->email . "/" . $user[0]['reset_password_token'] . "<br><br>If this wasn't requested by you, please ignore this mail.</td>
                                        <td></td>
                                    </tr>
                                    <tr bgcolor='#ffffff' style='backround-color: #ffffff; height: 60px;'>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr bgcolor='#ffffff'>
                                        <td></td>
                                        <td>Best regards<br><br>The SiteRocket team</td>
                                        <td></td>
                                    </tr>
                                    <tr bgcolor='#ffffff' style='height: 60px;'>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </center>
                        </tr>
                        <tr style='height: 60px;'>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </center>
            </body>
        </html>";                
        $headers = 'From: Team SiteRocket <r@rasmusandreas.dk>' . "\r\n" .
            'Reply-To: noreply@rasmusandreas.dk' . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . "\r\n" .
            "MIME-Version: 1.0" . "\r\n" .
            "Content-Type: text/html; charset=ISO-8859-1" . "\r\n";

        mail($to, $subject, $message, $headers);
        return response()->json("mail should be sent to $request->email password needs to be reset $request->frontendUrl", 200);
    }

    public function resetPassword(Request $request) {
        $user = User::where('email', $request->email)->where('reset_password_token', $request->resetToken)->get();
        if(count($user) === 1) {
            if($request->password === $request->passwordRepeat) {
                $user[0]->update([
                    'password' => Hash::make($request->password),
                    'reset_password_token' => null,
                ]);
                return response($user[0], 200);
            } else {
                return response()->json("The two inputs needs to be the same", 400);
            }
        } else {
            return response()->json("Error", 400);
        }
    }

    public function updateUser(Request $request) {
        if ($request->oldPassword != '' && $request->password != '') {
            if ($request->password === $request->passwordRepeat) {
                $user = User::where('id', auth()->user()->id)->get();
                if (Hash::check($request->oldPassword, $user[0]["password"])) {
                    $user[0]->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
                    return response($user[0], 200);
                } else {
                    return response()->json('The old password is not the correct one', 400);
                }
            } else {
                return response()->json('Passwords need to be the same', 400);
            }
        } else {
            $user = User::where('id', auth()->user()->id)->get();
            $user[0]->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return response($user[0], 200);
        }
    }
}
