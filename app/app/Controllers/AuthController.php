<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel as User;
use App\Libraries\Hash;
use App\Libraries\Auth;

class AuthController extends BaseController
{
    protected $helpers = ["url", "form"];

    public function loginForm()
    {
        return view("pages/auth/LoginPage", [
            "pageTitle" => "Login",
        ]);
    }

    public function signUpForm()
    {
        $data = [
            "pageTitle" => "Signup",
        ];
        return view("pages/auth/SignUpPage", $data);
    }

    public function forgotPassword()
    {
        $data = [
            "pageTitle" => "Forgot Password",
        ];
        return view("pages/auth/ForgotPasswordPage", $data);
    }

    public function loginHandler()
    {

        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");

        $isValid = $this->validate([
            "email" => [
                "rules" => "required|valid_email|is_not_unique[users.email]",
                "errors" => [
                    "is_not_unique" => "Email does not exist!"
                ]
            ],
            "password" => "required|min_length[5]|max_length[45]"
        ]);

        if (!$isValid) {
            return view("pages/auth/LoginPage", [
                "pageTitle" => "Login",
                "validation" => $this->validator
            ]);
        } else {
            $userInfo = (new User())->where("email", $email)->first();

            if (
                $userInfo["email_verified"] == null
            ) {
                $this->validator->setError('email', 'Email is not verified.');
                return view("pages/auth/LoginPage", [
                    "pageTitle" => "Login",
                    "validation" => $this->validator,
                    "email" => $email
                ]);
            }
            if (
                $userInfo["admin_blocked_email"] != null
            ) {
                $this->validator->setError('email', 'Email has been blocked by admin');
                return view("pages/auth/LoginPage", [
                    "pageTitle" => "Login",
                    "validation" => $this->validator,
                    "email" => $email
                ]);
            }

            if (!Hash::verify($password, $userInfo['password'])) {
                $this->validator->setError('password', 'Incorrect password');
                return view("pages/auth/LoginPage", [
                    "pageTitle" => "Login",
                    "validation" => $this->validator,
                    "email" => $email
                ]);
            }

            Auth::setAuth($userInfo);
            return redirect()->route("rt.profilepage");
        }
    }

    public function signUpHandler()
    {
        $isValid = $this->validate(
            [
                "name" => "required|min_length[5]|max_length[45]",
                "email" =>  "required|valid_email|is_unique[users.email]",
                "password" => "required|min_length[5]|max_length[45]"
            ]
        );

        if (!$isValid) {
            return view("pages/auth/SignUpPage", [
                "pageTitle" => "Signup",
                "validation" => $this->validator
            ]);
        } else {
            $user = (new User())->insert(([
                "name" =>  $this->request->getVar("name"),
                "email" => $this->request->getVar("email"),
                "password" => Hash::hash($this->request->getVar("password")),
                "email_verified" => date('Y-m-d H:i:s'),
                "role" => "USER"
            ]));

            $user = (new User())->find($user);
            Auth::setAuth($user);
            return redirect()->route("rt.profilepage");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("rt.login");
    }
}
