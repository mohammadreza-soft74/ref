<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\TokenTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    use TokenTrait;


    public function login(Request $request)
    {

        $user = $this->getUser($request);
        $response = $this->getToken($request);

        if ($response->status() !== 200) {
            return $response;
        }


        return new UserResource($user, $this->getTokenContent());
    }


    protected function getUser(Request $request)
    {

        $user = User::whereEmail( $request->email)->first();

        if (is_null($user))
            throw ValidationException::withMessages([
                'user' => 'کاربری با این ایمیل وجود ندارد'
            ]);

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'اطلاعات شما درست نیست'
            ]);
        }

        return $user;
    }
}
