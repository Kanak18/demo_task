<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $loginUser = Auth::user();
        

        if($loginUser->roles[0]->name=="admin")
        {
            $all_users = User::select('*')->where('id','!=',$loginUser->id)->get(); 
        }
        else 
        {
            $all_users = User::select('*')->where('id','!=',$loginUser->id)->where('added_by',$loginUser->id)->get();   
        }    


        // return task index view with paginated tasks
        return view('home/users', [            
            'all_users' => $all_users
        ]);
    }

    public function create()
    {
        return view('home/users_form_new');
    }
    
    public function show(User $user,Request $request)
    {
         // return task index view with paginated tasks
        return view('home/users_form_view', [            
            'user_info' => $user
        ]);        
    }

    /**
     * Store a new incomplete task for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        $loginUser = Auth::User();

        $validatedData = $request->validated();     

        $user = User::create([
            'name' => $validatedData['username'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'added_by' => $loginUser->id,
        ]);
       

        if($loginUser->roles[0]->name=="manager")
        {
            $user->assignRole('customer');
        }
        if($loginUser->roles[0]->name=="admin")
        {
            if($request->user_type=="2")
            {
                $user->assignRole('customer');
            }
            else if($request->user_type=="1")
            {
                 $user->assignRole('manager');
            }
        }
       
        // flash a success message to the session
        session()->flash('status', 'User Created!');

        // redirect to tasks index
        return redirect('/users');
    }

    /**
     * Mark the given task as complete and redirect to tasks index.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(User $user,Request $request) {

        

        if($request->_method == "PUT") {
            // Update the task
            $user->name = $request->name;
            $user->username = $request->username;
            $user->save();
            $msg = "User info Updated!";
        }

        // flash a success message to the session
        session()->flash('status', $msg);

        // redirect to tasks index
        return redirect('/users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        // flash a success message to the session
        session()->flash('status', 'User Deleted!');

        // redirect to tasks index
        return redirect('/users');
    }

    public function edit(User $user)
    {

        // return task index view with paginated tasks
        return view('home/users_form', [
            'user_obj' => $user,
            'logged_user' => Auth::user()
        ]);
    }
    
}
