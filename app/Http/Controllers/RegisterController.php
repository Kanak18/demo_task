<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {        
        // $user = User::create($request->validated());
        $validatedData = $request->validated();     




        $user = User::create([
            'name' => $validatedData['username'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        if($request->user_type==1)
        {            
            $user->assignRole('manager');
        }
        else
        {
            $user->assignRole('customer');

        }


        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }
}