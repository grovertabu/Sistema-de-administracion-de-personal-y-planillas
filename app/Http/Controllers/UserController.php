<?php

namespace App\Http\Controllers;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only('edit','update');
    }
    public function index()
    {
        $users = User::where('id','!=',auth()->user()->id)->get();
        return view('users.index',compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {

       $request->validate([
           'name'=>'required|min:5|max:100|unique:users',
           'username'=>'required|min:3|max:20|unique:users',
           'password'=>'required',
           'tipo_user'=>'required',
       ]);

       User::create($request->only('name','username','tipo_user')+[
            'password'=>bcrypt($request->input('password')),
       ]);
       return redirect()->route('users.index')->with('crear','ok');
    }


    public function show($id)
    {
        //
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit',compact('user', 'roles'));
    }


    public function update(Request $request, User $user)
    {
        if ($request->roles==1) {
            $user->tipo_user = "administrador";
            $user->save();
        }
        elseif($request->roles==2){
            $user->tipo_user = "rrhh";
            $user->save();
        }
        elseif($request->roles==3){
            $user->tipo_user = "trabajador";
            $user->save();
        }
        else{
            $user->tipo_user = "";
            $user->save();
        }

        $user->roles()->sync($request->roles);
        return redirect()->route('users.edit', $user)->with('info','Se asigno los roles correctamente');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
