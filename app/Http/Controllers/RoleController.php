<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;





class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'data'=>Role::all()
        ] ;
        
        
    }
    public function index_selects()
    {
        return Role::all();
        
    }
    public function view_role(){
        return view('rol');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $succes = false;
        $error = '';
       
        DB::beginTransaction();
        try {  
        Role::create(['name' => $request->rol]);            
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $role;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role)
    {
        // return $role;
     $rol_bd =  DB::table('model_has_roles')->where('model_id',Auth::user()->id)->get();
    //  return $rol_bd[0]->role_id;

        if ($rol_bd[0]->role_id == $role) {
             return [
                 'resp' => false
             ];
        }else {
            DB::table('roles')->where('id',$role)->delete();
            return [
                'resp' => true
            ];
        }
        

    }
}
