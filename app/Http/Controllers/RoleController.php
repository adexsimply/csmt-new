<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Plugin\Addon;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $roles = Addon::isEmpty($roles);
        return view('roles.index',compact('roles'));
    }

    

    /*Display role creation form*/
    public function create(Request $request)
    {
        $permissions = Permission::all();
        $permissions = Addon::isEmpty($permissions);

        if($request->ajax())
            return view('roles.ajax.create', compact('permissions'))->render();

        else
            return view('roles.create', compact('permissions'));
    }

    

    /*Collect role creation data from form and store it*/
    public function store(Request $request)
    {

        /*Validate input data*/
        $this->validate($request, [
            'name'=>'required|unique:roles|max:20',
            'permissions' =>'required',
            ]
        );


        try {
            DB::transaction(function() use($request){
                $role = new Role();
                $role->name = strtolower($request->name);
                $role->save();

                if($request->has('permissions')){
                    $role->permissions()->attach($request->permissions);
                }
            });
            
        } catch (Exception $e) {
            if($request->ajax())
                return response(['status'=>0,'message'=>$e->getMessage()]);

            else
                return redirect()->route('roles.index')->with('error',$e->getMessage());
        }

        if($request->ajax())
                return response(['status'=>1,'message'=>'Role created','retain'=>301]);

        else
            return redirect()->route('roles.index')->with('success','Roles added successfully');
    }

    

    /*Display update form*/
    public function edit($id,Request $request)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permissions = Addon::isEmpty($permissions);

        if ($request->ajax())
            return view('roles.ajax.edit',compact('role', 'permissions'))->render();
        
        return view('roles.edit', compact('role', 'permissions'));
    }

    

    /*Process update form*/
    public function update(Request $request)
    {   
        $id = $request->id;
    //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:20|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);


        try {
            DB::transaction(function() use($request,$id){

                $role = Role::findOrFail($id);
                $role->fill($request->except(['permissions']))->save();

                if($request->has('permissions')){
                    $role->permissions()->sync($request->permissions);
                }
            });
        } catch (Exception $e) {
            if($request->ajax())
                return response(['status'=>0,'message'=>$e->getMessage()]);

            else
                return redirect()->route('roles.index')->with('error',$e->getMessage());
        }

        if($request->ajax())
                return response(['status'=>1,'message'=>'Role updated successfully','retain'=>301]);

        else
            return redirect()->route('roles.index')->with('success','Roles updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role,Request $request)
    {
        if($role->delete()){
            if($request->ajax())
                return response(['status'=>1,'message'=>'Role deleted']);
            else
                return redirect()->route('roles.index')
            ->with('success',
             'Role deleted successfully!');
        }

        else{
            if($request->ajax())
                return response(['status'=>0,'message'=>'Connection error']);

            else
                return redirect()->route('roles.index')
            ->with('success',
             'Connection error');
        }
    }
}
