<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
    
        $validator = Validator::make($request->input(), $rules);
    
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        
        $credentials = $request->only('email', 'password');
        $user = User::where('email',$request->email)->first();
        
        if($user->role == 2 && $user->tel == "" )
        {
            $response = [
                'success' => false,
                'message' => 'Vous ne pouvez pas se connecter : Votre compte n\'est pas encore activé'
            ];
            return response()->json($response);
        }else{
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['name'] = $user->name;
                $success['role'] = $user->role;

                $response = [
                    'success' => true,
                    'data' => $success,
                    'message' => 'Users login succesfully'
                ];

                return response()->json($response,200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'L\'email ou bien le mot de passe est incorrect'
                ];
                return response()->json($response);
            }
        }
        throw ValidationException::withMessages([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }
    public function logout(){
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function profil($email){
        $profil = User::where('email',$email)->first();
        return response()->json($profil);
    }
}
