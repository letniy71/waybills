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
      $role = Role::where('name',$data['role'])
                        ->first();
      if($role->idRole == 1) {
        $brigade = Brigade::where('nameBrigade',0)
                        ->first();
      } else {
        $brigade = Brigade::where('active',1)
                        ->where('nameBrigade',$data['nameBrigade'])
                        ->first();
      }

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
    $idUser = $request->id;
    $user = User::where('id', $idUser)
              ->delete();
    return redirect()->route('register');
  }


//Передаем данные для редактирования на страницу редакирования
public function showEditUser(Request $request){
    $idUser = $request->id;
    $user = User::where('id',$idUser)
            ->first();
    $users = User::all();
    $brigade = Brigade::where('active', 1)
                ->get(); 
    $role = Role::all();

    return view('auth/edit_user', ['users'=>$users,'brigade'=>$brigade, 'role'=>$role, 'user'=>$user]); 
  }

//Редактируем пользователя
public function editUser(Request $request){
    $role = Role::where('name',$request->role)
              ->first();
    if($role->idRole == 1) {
      $brigade = Brigade::where('nameBrigade',0)
              ->first();
    }else{
      $brigade = Brigade::where('nameBrigade',$request->nameBrigade)
              ->first();
    }
    $password = Hash::make($request->password);
    DB::update('update users set name  = ?, password = ?, email = ?, idRole = ?, idBrigade = ?, login = ? where id = ?', [$request->name,$password,$request->email,$role->idRole,$brigade->idBrigade,$request->login,$request->id]);
     return redirect()->route('register');
  }
 
}
