<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\ChangePassRequest;
use App\Results;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {

        $input = $request->all();
        if (!User::whereEmail($request->email)->first()) {
            $input['password'] = Hash::make($input['password']);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $input['password'];
            $user->role_id = 3;
            $user->level_id = 1;
            $user->save();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            return response()->json([
                'token'    => $success['token'],
                'user'     => $success['name']
            ]);
        } else {
            return response()->json(['error' => 'Email đã tồn tại.']);
        }
    }

    public function login(AuthLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::whereEmail($request->email)->first();
            if ($user->active == 1) {
                return response()->json([
                    'token'    => $request->user()->createToken($request->input('device_name'))->accessToken,
                    'user'     => $request->user()
                ]);
            } else {
                return response()->json(['error' => 'Unauthorised']);
            }
        } else {
            return response()->json(['error' => 'Unauthorised']);
        }
    }

    public function user()
    {
        return response()->json(auth()->user());
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return response()->json(['message' => 'Вы вышли из системы'], 200);
    }
    public function editUser(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imgName = time() . '.' . $extention;
            $image->move(public_path('images'), $imgName);
        }
        DB::table('users')
            ->where('id', Auth::id())
            ->update(['avatar' => $imgName]);
        return response()->json(User::find(Auth::id()));
    }
    public function editProfile(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->birthday) {
            $user->birthday = $request->birthday;
        }
        $user->save();
        return response()->json($user);
    }
    public function change_password(ChangePassRequest $request)
    {
        $user_id = Auth::guard('api')->user()->id;

        try {
            if ((Hash::check(request('old_pass'), Auth::user()->password)) == false) {
                $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
            } else if ((Hash::check(request('new_pass'), Auth::user()->password)) == true) {
                $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
            } else {
                User::where('id', $user_id)->update(['password' => Hash::make($request['new_pass'])]);
                $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
            }
        } catch (\Exception $ex) {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            $arr = array("status" => 400, "message" => $msg, "data" => array());
        }

        return response()->json($arr);
    }
}
