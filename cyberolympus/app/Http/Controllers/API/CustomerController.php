<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function searchCustomer(Request $request){
        $customer = Customer::where('nama', 'like', '%' . $request->keyword . '%')->get();
        if($customer){
            $response = [
            'status_code' => Response::HTTP_FOUND,
            'success' => true,
            'message' => "success",
            'data' => $customer,
            'pagination' => Customer::where('nama', 'like', '%' . $request->keyword . '%')->paginate(10)->links()->render()
            ];
        }
        return response()->json($response);
    }

    public function cari(Request $request){
        $response = [
            'status_code' => Response::HTTP_FOUND,
            'success' => true,
            'message' => "success",
            'data' => Customer::whereBetween('tanggal_registrasi', [$request->tanggalawal." 00:00:00", $request->tanggalakhir." 23:59:59"])->orderBy('nama', 'ASC')->paginate(10),
            'pagination' => Customer::whereBetween('tanggal_registrasi', [$request->tanggalawal." 00:00:00", $request->tanggalakhir." 23:59:59"])->orderBy('nama', 'ASC')->paginate(10)->links()->render(),
        ];
        return response()->json($response);
    }
    public function nexthalaman(){
        $response = [
            'status_code' => Response::HTTP_OK,
            'success' => true,
            'message' => "success",
            'data' => Customer::orderBy('nama', 'ASC')->paginate(10),
            'pagination' => Customer::orderBy('nama', 'ASC')->paginate(10)->links()->render(),
        ];
        return response()->json($response, $response['status_code']);
    }
    public function index()
    {
        // $data = Customer::paginate(1);
        
        $response = [
            'status_code' => Response::HTTP_OK,
            'success' => true,
            'message' => "success",
            'data' => Customer::orderBy('nama', 'ASC')->paginate(10),
            'pagination' => Customer::orderBy('nama', 'ASC')->paginate(10)->links()->render(),
        ];
        return response()->json($response, $response['status_code']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
            'alamat' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_FORBIDDEN);
            // return response()->json([
            //     'message' => "Failed " . $validator->errors(),
            //     'status' => Response::HTTP_FORBIDDEN
            // ])
        }
        try {
            $customers = Customer::create($request->all());
            $response = [
                'message' => 'Customer created',
                'data' => $customers
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = Customer::where('id', $id)->first();
        if (isset($customers)) {
            $response = [
                'status_code' => Response::HTTP_FOUND,
                'success' => true,
                'message' => "success",
                'data' => $customers,
            ];
        } else {
            $response = [
                'status_code' => Response::HTTP_NOT_FOUND,
                'success' => false,
                'message' => "Data Not Found",
            ];
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
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
        $customers = Customer::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'alamat' => ['required'],
            'nomor_telepon' => ['required', 'numeric']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $customers->update($request->all());
            $response = [
                'message' => 'Customers updated',
                'data' => $customers
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customers = Customer::findOrFail($id);
        try {
            $customers->delete();
            $response = [
                'message' => 'Customers deleted',
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
