<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addService(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'company_code'=>'required',
            'company_name'=>'required|max:255',
            'company_address'=>'required|max:255',
            'service_name'=>'required|max:255',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }

        Service::create([
            'company_code'=>request('company_code'),
            'company_name'=>request('company_name'),
            'company_address'=>request('company_address'),
            'service_id'=>request('service'),
            'service_name'=>request('service_name')
        ]);

        return response()->json(['ok'=>'Service created successfully']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        $service->update(
        $request->only(['company_code','name','address, service_name'])
        );

        return response()->json(['Service has been updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $service = Service::find($id);
        if($service==null){
            return response()->json(['There is no service with that id']);
        }
        $service->delete();
        return response()->json(['The service has been deleted successfully']);
        }
    }
