<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        UserResource::withoutWrapping();
        return UserResource::collection(User::where('role',1)->orderBy('id', 'DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employe = new User;
        $employe->name          = $request->get('name');
        $employe->email         = $request->get('email');
        $employe->role          = 1;
        $employe->password      = Hash::make($request->password);
        $employe->save();
        return response(['status'=>'success',"message"=>"Your Data Added Successfully"]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::find($id);
        $user =[
            'id'         => $admin->id,
            'name'       => $admin->name,
            'email'      => $admin->email,
        ];
        return response($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name'      => 'required',
            'email'     => 'required|email',
        );
        $messages = [
            'name.required'      => 'Le champ nom est obligatoire.',
            'email.required'     => 'Le champ email est obligatoire.',
            'email.email'        => 'Veuillez entrer une adresse email valide.',
        ];

        $validator = Validator::make($request->input(), $rules,$messages);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }else{
            $admin =  User::find($id);
            if($admin){
                $admin->name         = $request->get('name');
                $admin->email        = $request->get('email');
                if($request->get('password')){
                    $admin->password     = Hash::make($request->get('password'));
                }
                $admin->update();
                return response()->json([
                    'status'  => 200,
                    'message' => 'User updated successfully',
                ],200) ;

            }else{
                return response()->json([
                    'status'  => 404,
                    'message' => 'No Admin ID found',
                ],401) ;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = User::find($id);
        $admin->delete();
        return response()->json('successful',200);
    }

    //compter le nombre des sociétés , des employées ...
    public function count()
    {
        $countemployee = User::where('role',2)->count();
        $countadmins   = User::where('role',1)->count();
        $countcompany  = Company::count();
        $countlogs     = Log::count();
        $count =[
            'countemploye' => $countemployee,
            'countadmins'  => $countadmins,
            'countcompany' => $countcompany,
            'countlogs'    => $countlogs,
        ];
        return response()->json($count,200);
    }
}
