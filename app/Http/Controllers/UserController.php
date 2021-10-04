<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Plugin\Addon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate();
        $users = Addon::isEmpty($users);
        return view('users.index', compact('users'));
    }
 

    /*Collect all roles and display user creation form*/
    public function create(Request $request)
    {
        $roles = Role::get(); 
        $roles = Addon::isEmpty($roles);   

        if($request->ajax())    
        	return view('users.ajax.create', compact('roles'))->render();

        else
        	return view('users.create', compact('roles'));
    }


    /*Store created user data*/
    public function store(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:1|confirmed',
            'roles' => 'required'
        ]);

        try {
        	DB::transaction(function() use($request){
        		$user = User::create($request->except('roles'));

        		/*Assign roles*/
        		if($request->has('roles')){
		            $user->roles()->attach($request->roles);
		        }
        	});
        } catch (Exception $e) {
            if($request->ajax())
                return response(['status'=>0,'message'=>$e->getMessage()]);

            else
                return redirect()->route('users.index')->with('error',$e->getMessage());
        }
        

        if($request->ajax())
        	return response(['status'=>1,'message'=>'User account created','retain'=>301]);

        else
        	return redirect()->route('users.index')->with('success','User created'); 
    }



    /*Create user edit form*/
    public function edit($id,Request $request){
        $user = User::findOrFail($id);
        $roles = Role::get(); 
        $role = Addon::isEmpty($roles);

        if($request->ajax())
        	return view('users.ajax.edit', compact('user', 'roles'))->render(); 

        else
        	return view('users.edit', compact('user', 'roles')); 
    }



    public function update(Request $request){  
    	$id = $request->id;
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
        ]);

        try {
        	DB::transaction(function() use($request,$id){
        		$user = User::findOrFail($id); 

		        $user->fill($request->except('roles'))->save();

		        /*Assign role*/
		        if ($request->has('roles')) {
		            $user->roles()->sync($request->roles);        
		        }        
		        else {
		        	/*Revoke role*/
		            $user->roles()->detach(); 
		        }
        	});
        } catch (Exception $e) {
            if($request->ajax())
                return response(['status'=>0,'message'=>$e->getMessage()]);

            else
                return redirect()->route('users.index')->with('error',$e->getMessage());
        }

        if($request->ajax())
        	return response(['status'=>1,'message'=>'User updated','retain'=>301]);

        else
        	return redirect()->route('users.index')->with('success',
             'User successfully updated');
    }



    /*Delete user*/
    public function destroy(User $user,Request $request){
        if($user->delete()){
            if($request->ajax())
                return response(['status'=>1,'message'=>'user deleted']);
            else
                return redirect()->route('users.index')
            ->with('success',
             'user deleted successfully!');
        }

        else{
            if($request->ajax())
                return response(['status'=>0,'message'=>'Connection error']);

            else
                return redirect()->route('users.index')
            ->with('success',
             'Connection error');
        }
    }


}
