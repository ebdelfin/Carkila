<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Owner;
use App\Traits\ActivationTrait;
use App\Traits\CaptchaTrait;
use App\Traits\CaptureIpTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

//RegistersUsers trait
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use ActivationTrait;
    use CaptchaTrait;
    use RegistersUsers;


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $data = [
            'roles' => Role::whereIn('slug', ['vehicle.owner', 'renter'])->get(),
        ];

        return view('auth.register')->with($data);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));  

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }



    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/activate';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['captcha'] = $this->captchaCheck();

        if (!config('settings.reCaptchStatus')) {
            $data['captcha'] = true;
        }


        if ($data["user_role"] === "Vehicle Owner") {
            return Validator::make($data,
                [
                    'user_role'             => 'required|in:Vehicle Owner',
                    'license_number'        => 'required',
                    'license_expiry'        => 'required',
                    'name'                  => 'required|max:255|unique:users',
                    'first_name'            => 'required',
                    'last_name'             => 'required',
                    'street'                => 'required',
                    'barangay'              => 'required',
/*                    'gender'              => 'required',*/
                    'city'             => 'required',
/*                    'birth_date'             => 'required',*/
                    'email'                 => 'required|email|max:255|unique:users',
                    'password'              => 'required|min:6|max:20|confirmed',
                    'password_confirmation' => 'required|same:password',
                    'image'                 => 'required|image',
                ],
                [
                    'name.unique'                   => trans('auth.userNameTaken'),
                    'name.required'                 => trans('auth.userNameRequired'),
                    'first_name.required'           => trans('auth.fNameRequired'),
                    'last_name.required'            => trans('auth.lNameRequired'),
                    'email.required'                => trans('auth.emailRequired'),
                    'email.email'                   => trans('auth.emailInvalid'),
                    'password.required'             => trans('auth.passwordRequired'),
                    'password.min'                  => trans('auth.PasswordMin'),
                    'password.max'                  => trans('auth.PasswordMax'),
                ]
            );
        } else {
            return Validator::make($data,
            [
                'user_role'             => 'required|in:Renter',
                'name'                  => 'required|max:255|unique:users',
                'first_name'            => 'required',
                'last_name'             => 'required',
      /*          'gender'             => 'required',*/
                'street'                => 'required',
                'barangay'                => 'required',
                'city'             => 'required',
/*                'birth_date'             => 'required',*/
                'email'                 => 'required|email|max:255|unique:users|domainos:allow',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
            ],
            [
                'name.unique'                   => trans('auth.userNameTaken'),
                'name.required'                 => trans('auth.userNameRequired'),
                'first_name.required'           => trans('auth.fNameRequired'),
                'last_name.required'            => trans('auth.lNameRequired'),
                'email.required'                => trans('auth.emailRequired'),
                'email.email'                   => trans('auth.emailInvalid'),
                'password.required'             => trans('auth.passwordRequired'),
                'password.min'                  => trans('auth.PasswordMin'),
                'password.max'                  => trans('auth.PasswordMax'),
            ]
        );
        }




        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $ipAddress = new CaptureIpTrait();


        $role = $data['user_role']; //Retrieving the user_role field

        $role_r = Role::where('name', '=', $role)->first();
            
        

        $user = User::create([
                'name'              => $data['name'],
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'email'             => $data['email'],
     /*           'gender'             => $data['gender'],*/
                'street'            => 'required',
                'barangay'          => 'required',
                'mobile_number'     => $data['mobile_number'],
                'city'              => $data['city'],
    /*            'birth_date'        => $data['birth_date'],*/
                'password'          => bcrypt($data['password']),
                'token'             => str_random(64),
                'signup_ip_address' => $ipAddress->getClientIp(),
                'activated'         => !config('settings.activation'),
            ]);

        if ($role_r->slug == "vehicle.owner") {
            $owner = Owner::create([
                'license_number'                  => $data['license_number'],
                'license_expiry'                  => $data['license_expiry'],
                'image'                           => $data['featured_image'],
                'user_id'                         => $user->id,
            ]);
            if ($request->hasFile('featured_image')) {
                $image  = $request->file('featured_image');
                $file_name =  time() . '.' . $image->getClientOriginalExtension();
                $location = public_path() . '/images/users/id/' . $owner->user_id . '/uploads/licenses/';

                // Make the user a folder and set permissions

                if (!file_exists($location)) {
                    mkdir($location, 666, true);
                }


                Image::make($image)->save($location.$file_name);

                $owner->image = '/images/users/id/' . $owner->user_id . '/uploads/licenses/'. $file_name;
            }
        }

        $user->attachRole($role_r);

        $this->initiateEmailActivation($user);

        return $user;
    }
}
