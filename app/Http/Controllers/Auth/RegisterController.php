<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Brigade;
use App\Models\Role;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $brigade = Brigade::where('active',1)
                        ->where('nameBrigade',$data['nameBrigade'])
                        ->first();


        $role = Role::where('name',$data['role'])
                        ->first();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'login'=> $data['login'],
            'idBrigade'=> $brigade->idBrigade,
            'idRole'=> $role->idRole,
        ]);
    }

    //Получаем список пользователей
    public function getUsers()
    {
        $users = User::where('active', 1)
                ->get();
        $brigade = Brigade::where('active', 1)
                ->get(); 
        $role = Role::all();

        return view('auth/register', ['users'=>$users, 'brigade'=>$brigade, 'role'=>$role]); 
    }

    //Удаляем Пользоватля
  public function deleteUser(Request $request){

    DB::update('update users set active = 0 where id = ?', [$request->id]);

/* Так не работает .....
    $auto = Auto::find($request->idAuto);
    $auto->active =0;
    $auto->save();
    */
    return redirect()->route('register');
  }

/*public function editUserShow(Request $request){
    $users = User::where('id',$request->id)
            ->first();
    $brigade = Brigade::where('active', 1)
                ->get(); 
        $role = Role::all();

    return view('auth/edit_user', ['users'=>$users,'brigade'=>$brigade, 'role'=>$role]); 
  }
public function editRegisterUser(Request $request){
    $role = Role::where('name',$request->role)
              ->first();
    $brigade = Brigade::where('nameBrigade',$request->nameBrigade)
              ->first();
    DB::update('update users set name  = ?, password = ?, email = ?, idRole = ?, idBrigade = ? where id = ?', [$request->name,$request->password,$request->email,$role->idRole,$brigade->idBrigade,$request->id]);
    
              
    /*$user = User::find($request->id);
    $user->name = $request->name;
    $user->password = $request->password;
    $user->email = $request->email;

    $user->idRole = $role->idRole;
    $user->name = $brigade->idBrigade;

    $auto->save();



     return redirect()->route('register');
  }*/
 
}
