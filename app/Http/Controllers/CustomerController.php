<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
// use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(){

        $customers = Customer::latest()->get();
        return view('welcome',compact('customers'));
        
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $data = [
            'name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
        $customer = Customer::create($data);
        return response()->json($customer,200);

    }
    public function edit($id){
        $customer = Customer::findOrfail($id);
        if($customer){
            return response()->json($customer,200);
        }else{
            return 'customer not found';
        }
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);   
        $data = [
            'name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
        Customer::where('id',$id)->update($data);
        $customer = Customer::findOrfail($id);

        return response()->json($customer,200);
    }
    public function delete($id){
        $customer = Customer::findOrfail($id);
        if($customer){
            $customer->delete();
            return response()->json('Customer delete successfully!',200);
        }else{
            return response()->json('something gone wrong!',200);
        }
    }
}
