<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Auth;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Facades\Validator;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        CompanyResource::withoutWrapping();
        return CompanyResource::collection(Company::orderBy('created_at')->paginate(6));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if(request('q') != null)
        {
            CompanyResource::withoutWrapping();
            $companies['data']= CompanyResource::collection(Company::where('nom','like','%'. request('q'). '%')->get());
            return response()->json($companies,200);
        }else{
            return $this->index();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company;
        $company->nom           =  $request->get('name');
        $company->raison_social = $request->get('raison');
        $company->email         = $request->get('email');
        $company->adresse       = $request->get('adresse');
        $company->tel           = $request->get('tel');
        $company->date_creation = $request->get('date');
        $company->description   = $request->get('description');
        $company->id_admin      = Auth::user()->id;
        $company->save();
        return response(['status'=>'success',"message"=>"Your Data Added Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        CompanyResource::withoutWrapping();
        $company = Company::find($id);
        if($company){
            return new CompanyResource($company);
        }else{
            return response([
                'status'=>404,
                "message"=>"No company ID Found"],404);
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
        CompanyResource::withoutWrapping();
        $company = Company::find($id);
        if($company){
            return new CompanyResource($company);
        }else{
            return response([
                'status'=>404,
                "message"=>"No company ID Found"],404);
        }
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
            'nom'           => 'required',
            'raison_social' => 'required',
            'email'         => 'required|email',
            'adresse'       => 'required',
            'tel'           => 'required|max:10|min:10',
            'date_creation' => 'required',
            'description'   => 'required',
        );
    
        $validator = Validator::make($request->input(), $rules);
    
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }else{
            $company =  Company::find($id);
            if($company){
                $company->nom           = $request->get('nom');
                $company->raison_social = $request->get('raison_social');
                $company->email         = $request->get('email');
                $company->adresse       = $request->get('adresse');
                $company->tel           = $request->get('tel');
                $company->date_creation = $request->get('date_creation');
                $company->description   = $request->get('description');
                $company->update();
                return response()->json([
                    'status'  => 200,
                    'message' => 'Company updated successfully',
                ],200) ;
            }else{
                return response()->json([
                    'status'  => 404,
                    'message' => 'No company ID found',
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
        $company = Company::find($id);
        $company->delete();
        return response()->json('successful',200);
    }
}
