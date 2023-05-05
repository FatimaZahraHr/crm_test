<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Notifications\Invitation;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Events\History;
use Illuminate\Support\Facades\Redirect;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        UserResource::withoutWrapping();
        return UserResource::collection(User::where('role',2)->orderBy('created_at', 'DESC')->paginate(6));
    }
    //Chercher un employéé par son nom
    public function search()
    {
        if(request('q') != null)
        {
            UserResource::withoutWrapping();
            $employees['data']= UserResource::collection(User::where('name','like','%'. request('q'). '%')->where('role',2)->get());
            return response()->json($employees,200);
        }else{
            return $this->index();
        }
    }
    /**
     * Sauvegarder un nouveau employée(Inviter).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'company' => 'required',
            'name'    => 'required',
            'email'   => 'required|email|unique:users,email',
        );
        $messages = [
            'company.required' => 'Le champ société est obligatoire.',
            'name.required'    => 'Le champ nom est obligatoire.',
            'email.required'   => 'Le champ email est obligatoire.',
            'email.email'      => 'Veuillez entrer une adresse email valide.',
            'email.unique'     => 'Cette adresse email est déjà utilisée.',
        ];
        $validator = Validator::make($request->input(), $rules,$messages);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }else{
            $user = Auth::user();
            $employe = new User;
            $employe->name         = $request->get('name');
            $employe->email        = $request->get('email');
            $employe->role         = 2;
            $employe->id_company   = $request->get('company');
            $employe->save();
            $company = Company::find($request->get('company'));

            //envoyer une notification  pour inviter un employée
            $user = User::where('email',$request->email)->first();
            $user->notify(new Invitation($user));

            //Enregistrer les logs
            $message="a invite l'employé “".$request->get('name')."” à joindre la société “".$company->name."” ";
            event(
                new History($user,$message)
            );
        }

        return response(['status'=>'success',"message"=>"Your Data Added Successfully"]);
    }

    /**
     * Afficher l'employée par id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        UserResource::withoutWrapping();
        $user = User::find($id);
        if($user){
            return new UserResource($user);
        }else{
            return response([
                'status'=>404,
                "message"=>"No employee ID Found"],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = User::find($id);
        $emp =[
            'id'         => $employee->id,
            'name'       => $employee->name,
            'email'      => $employee->email,
            'tel'        => $employee->tel,
            'adress'     => $employee->adress,
            'birthday'   => $employee->birthday,
            'company'    => $employee->company->nom,
        ];
        return response($emp, 200);
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
            'adress'    => 'required',
            'email'     => 'required|email',
            'birthday'  => 'required',
            'tel'       => 'required|max:10|min:10',
        );
        $messages = [
            'name.required'      => 'Le champ nom est obligatoire.',
            'adress.required'    => 'Le champ adresse est obligatoire.',
            'email.required'     => 'Le champ email est obligatoire.',
            'birthday.required'  => 'Le champ date de naissance est obligatoire.',
            'tel.required'       => 'Le champ téléphone est obligatoire.',
            'tel.max'            => 'Le champ téléphone ne doit pas dépasser 10 chiffres',
            'tel.min'            => 'Le champ téléphone doit contenir 10 chiffres',
            'email.email'        => 'Veuillez entrer une adresse email valide.',
        ];

        $validator = Validator::make($request->input(), $rules,$messages);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }else{
            $employe =  User::find($id);
            if($employe){
                $employe->name         = $request->get('name');
                $employe->adress       = $request->get('adress');
                $employe->email        = $request->get('email');
                $employe->birthday     = $request->get('birthday');
                $employe->tel          = $request->get('tel');
                if($request->get('password')){
                $employe->password     = Hash::make($request->get('password'));
                }
                $employe->status       = 2;
                $employe->update();
                return response()->json([
                    'status'  => 200,
                    'message' => 'User updated successfully',
                ],200) ;
                if ($request->route()->named('profile')) {
                    //save logs
                    $message=" “".$request->get('name')."” a confirmé l'invitation ";
                    event(
                        new History($user,$message)
                    );
                }

            }else{
                return response()->json([
                    'status'  => 404,
                    'message' => 'No Employe ID found',
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
        $employee = User::find($id);
        $employee->delete();
        return response()->json('successful',200);
    }
    /**
     * cancel the invitation
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $employe =  User::find($id);
        $employe->status   = 3;
        $employe->update();

        $user = Auth::user();
        //save logs
        $message="a annulé l'invitation de “".$employe->nom."”";
        event(
            new History($user,$message)
        );
        return response()->json('successful',200);
    }

    //lien de l'invitation
    public function profil(Request $request)
    {
        $employe =  User::where('email',$request->email)->first();
        if($employe->status == null || $employe->status == 1){//statut non confirmé ou bien validé
          $employe->status   = 1;
          $employe->update();
        
        //save logs
        $message=" “".$employe->name."” a validé l'invitation ";
        event(
            new History($employe,$message)
        );
          return view('invitation');
        }
        if($employe->status == 3) //statut annulé
        {
          return view('notfound');
        }
        else{ //statut confirmé
            return Redirect::to('/login');
        }
    }
    //afficher les collègues d'un employée
    public function colleagues($id)
    {
        $user = User::find($id);
        UserResource::withoutWrapping();
        return UserResource::collection(User::where('id_company',$user->id_company)->orderBy('id', 'DESC')->paginate(6));
    }
}
