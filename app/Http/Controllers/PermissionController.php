<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Plugin\Addon;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    
    /*Display all permissions*/
    public function index()
    {
        $permissions = Permission::all();
        $permissions = Addon::isEmpty($permissions);
        return view('permissions.index',compact('permissions'));
    }

    

    /*Display create permission form*/
    public function create(Request $request)
    {
        $roles = Role::get(); //Get all roles
        $roles = Addon::isEmpty($roles);

        if($request->ajax())
            return view('permissions.ajax.create',compact('roles'))->render();

        else
            return view('permissions.create',compact('roles'));
    }

    


    /*Process permission creation form*/
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:20',
        ]);

        try{
            DB::transaction(function() use($request){
                $permission = new Permission();
                $permission->name = strtolower($request->name);
                $permission->save();

                if ($request->has('roles')){ 
                    foreach ($request->roles as $value) {
                        $role = Role::find($value); 
                        $role->permissions()->attach($permission);
                    }
                }
            });
        } catch (Exception $e) {
            if($request->ajax())
                return response(['status'=>0,'message'=>$e->getMessage()]);

            else
                return redirect()->route('permissions.index')->with('error',$e->getMessage());
        }
       

        if($request->ajax())
            return response(['status'=>1,'message'=>'Permission created','retain'=>301]);

        return redirect()->route('permissions.index')->with('success','Permission added successfully');
    }




    /*Display edit permission form*/
    public function edit($id,Request $request)
    {
        $permission = Permission::findOrFail($id);

        
        if($request->ajax())
            return view('permissions.ajax.edit', compact('permission'))->render();

        else
            return view('permissions.edit', compact('permission'));
    }

    
    /*Store permission update*/
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);
        $permission->name=strtolower($request->name);
        $permission->save();

        if ($request->ajax())
            return response(['status'=>1,'message'=>'Permission edited','retain'=>301]);

        else
            return redirect()->route('permissions.index')
            ->with('success',
             'Permission'. $permission->name.' updated!');
    }

    
    /*Delete permission*/
    public function destroy(Permission $permission,Request $request)
    {
        if($permission->delete()){
            if($request->ajax())
                return response(['status'=>1,'message'=>'Permission deleted']);
            
            else
                return redirect()->route('permissions.index')
            ->with('success',
             'Permission deleted successfully!');
        }

        else{
            if($request->ajax())
                return response(['status'=>0,'message'=>'Connection error']);

            else
                return redirect()->route('permissions.index')
            ->with('success',
             'Connection error');
        }

    }
}
