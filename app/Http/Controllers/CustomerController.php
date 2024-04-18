<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

// Learn Best Practice use GIT for Project

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  Fungsi Untuk menampilkan seluruh data
    public function index(){
    try {
        $customers = Customer::paginate(10);

        if ($customers->isEmpty()) {
            return response()->json([
                "code" => "200",
                "status" => "Success",
                "message" => "Data Empty"
            ]);
        }
        return response()->json([
            "code" => "200",
            "status" => "Success",
            "message" => "Successfully displayed customer data",
            "data" => $customers
        ]);
    } catch (\Exception $e) {
        return response()->json([
            "code" => "500",
            "status" => "Internal Server Error",
            "message" => $e->getMessage()
        ]);
    }
}


    /**
     * Store a newly created resource in storage.
     */

    //  fungsi untuk menambah data
    public function store(Request $request)
{
    try{
        $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email'
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'id_number' => $request->id_number,
            'dob' => $request->dob,
            'email' => $request->email
        ]);

        return response()->json([
            "code" => "200",
            "status" => "Success, Data customer has been added",
            "data" => $customer
        ]);
    }catch(\Exception $e){
        return response()->json([
            "code" => "400",
            "status" => "Bad Request",
            "message" => $e->getMessage()
        ]);
    }
}


    /**
     * Display the specified resource.
     */
    //fungsi untuk menampilkan data berdasarkan id
    public function show(Customer $customer)
    {
        return response()->json([
            'data' => $customer
        ]);
    }
    /**
     * Update the specified resource in storage.
     */

    //fungsi update data
    public function update(Request $request, Customer $customer){
        try{

            $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email'
            ]);

        $customer->name = $request->name;
        $customer->id_number = $request->id_number;
        $customer->dob = $request->dob;
        $customer->email = $request->email;
        $customer->save();

        return response()->json([
            "code" => "200",
            "status" => "Success, Data customer has been Update",
            "data" => $customer
        ]);
        }catch(Exception $e){
            return response()->json([
            "code" => "400",
            "status" => "Bad Request",
            "message" => $e->getMessage()
            ]);
        }
}

    /**
     * Remove the specified resource from storage.
     */

    //fungsi delete data
    public function destroy(Customer $customer)
    {
       try{
        $customer->delete();
        return response()->json([
            "code" => "200",
            "status" => "Success",
            "message" => "Data has been Deleted"
        ]);
       } catch(Exception $e){
        return response()->json([
            "code" => "500",
            "status" => "Internal Server Error",
            "message" => "Failed to Delete Data"
        ]);
       }
    }
}
