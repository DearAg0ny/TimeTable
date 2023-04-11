<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\CustomerCollection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customers()
    {
        return CustomerCollection::collection(Customer::all());
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCustomer(Request $request)
    {
            $validator = Validator::make($request->all(),[
                'code'=>'required|unique:customers',
                'name'=>'required',
                'address'=>'required'
        ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()]);
            }

            Customer::create([
                'code'=>request('code'),
                'name'=>request('name'),
                'address'=>request('address'),
            ]);

            return response()
                ->json(['success'=>'Customer created successfuly']);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update($request->all());
        return response()
            ->json(['message'=>'Customer updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['message'=>'Customer deleted']);
    }
}
