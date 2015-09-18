<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Validator;

use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        if(Auth::check()) {
            return redirect('/');
        } else {
            return view('auth.signin');
        }
    }

    public function authenticateUser()
    {
        $request = $this->request;
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->intended('/');
        } else {
            return redirect('/login')->with('errorMessage', 'The email and password you entered don\'t match.');
        }
    }

    public function unauthenticateUser()
    {
        Auth::logout();
        return redirect('/login')->with('successMessage', 'You have been logged out. See you soon!');
    }

    public function registerUser()
    {
        $request = $this->request;

        $redirectPath = '/login';
        if(Auth::check() && Auth::user()->priviledge) {
            $request->merge([
                'password_confirmation' => $request->input('password')
            ]);
            $redirectPath = '/';
        }

        $data = [
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
        ];

        $validation = $this->validator($data);
        if(!$validation->fails()) {
            User::create([
                'email' => $data['email'],
                'name' => $data['name'],
                'password' => bcrypt($data['password'])
            ]);
            if(Auth::check() && Auth::user()->priviledge) {
                return redirect('/')->with('successMessage', 'The user has been successfully created');
            }
            return redirect('/');
        } else {
            $ghostUser = User::onlyTrashed()->where('email', $data['email'])->first();

            if($ghostUser != null && $ghostUser->trashed()) {
                if(Auth::check() && Auth::user()->priviledge) {
                    $ghostUser->restore();
                    $ghostUser->save();
                    $response = 'A user with this username has already signed up, but deleted their account.<br />Their account, with their old login information, is active again.';
                } else {
                    $response = 'Looks like you\'ve signed up before, but have deleted your account.<br />Check your email to re-activate your account!';
                }
            } else {
                $response = $validation->messages();
            }

            return redirect($redirectPath)
                ->with('errorMessage', 'There were error(s) with the data you gave us:')
                ->with('errorValidationResponse', $response);
        }
    }

    public function deleteUser($userId)
    {
        if(Auth::check()) {
            if($userId != Auth::user()->id) {
                User::destroy($userId);
                return true;
            }
        }
        return false;
    }

    public function getUsers($paginate = null)
    {
        if($paginate == null)
            $users = User::all();
        else
            $users = User::paginate($paginate);
        return $users;
    }

    public function getUser($userId)
    {
        $user = User::find($userId);
        return $user;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|min:1|unique:Users',
            'name' => 'required|max:255|min:1|alpha_spaces',
            'password' => 'required|confirmed|min:6',
        ]);
    }
}
