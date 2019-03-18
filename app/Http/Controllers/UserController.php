<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


// use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;



class UserController extends Controller
{
    // use HasRoles;
    // protected $guard_name = 'web';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'data'=> User::with('roles_relacion')->orderBy('id','DESC')->get()
        ];
    }

    public function user_nombre($name){
        return User::where('nombre1',$name)->orWhere('nombre2',$name)->orWhere('apellido1',$name)->get();
    }

  
    public function view_user()
    {
       return view('usuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $succes = false;
        $error = '';
        $request->validate([
            'identificacion' => 'required|unique:users',
            'email' => 'required|unique:users',
        ]);
        DB::beginTransaction();
        try {  
        User::create([
            'nombre1' => $request->nombre1,
            'nombre2' => $request->nombre2,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'email' => $request->email,
            'identificacion'=> $request->identificacion,
            'avatar'=>$request->avatar,
            'password'=>Hash::make($request->identificacion)
        ])->assignRole($request->rol);
        DB::commit();
        $succes = true;
        } catch (\Throwable $th) {
            $succes = false;
            $error = $th->getMessage();
            DB::rollback();
        }
        if ($succes) {
            return [
                'resp' => true,
               // 'estudiante' => $estudiantes_tabla,
            ];
        }else {
            return [
                'resp' => false,
                'error' => $error
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $succes = false;
        $error = '';
        DB::beginTransaction();
        try {  
      User::where('id',$user->id)->update([
            'nombre1' => $request->nombre1,
            'nombre2' => $request->nombre2,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'avatar'=>$request->avatar,
            'password'=>Hash::make($request->identificacion)
        ]);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();

        $user->assignRole($request->rol);
        DB::commit();
        $succes = true;
        } catch (\Throwable $th) {
            $succes = false;
            $error = $th->getMessage();
            DB::rollback();
        }
        if ($succes) {
            return [
                'resp' => true,
            ];
        }else {
            return [
                'resp' => false,
                'error' => $error
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $error = null;
                $succes = null;
                DB::beginTransaction();
                try {
                    DB::table('model_has_roles')->where('model_id',$user->id)->delete();
                    User::where('id', $user->id)->delete();
                    DB::commit();
                    $succes = true;
                } catch (\Throwable $th) {
                    $succes = false;
                    $error = $th->getMessage();
                    DB::rollback();
                }
                
                if ($succes) {
                    return [
                        'resp' => true,
                    ];
                }else{
                    return [
                        'resp' => false,
                        'mensaje' => $error
                    ];
                }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }
}
