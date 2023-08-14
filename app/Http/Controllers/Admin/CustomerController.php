<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data=Customer::query();

        $data->when($request->q,function($q) use($request){
            $q->orWhere(function($query) use($request)
            {
                $query->where('name', 'LIKE','%'.$request->q.'%');
            })->orWhere(function($query) use($request)
            {
                $query->where('address', 'LIKE','%'.$request->q.'%');
            })->orWhere(function($query) use($request)
            {
                $query->where('phone_number', 'LIKE','%'.$request->q.'%');
            });
        });

        return response()->json([
            "data"=>$data->with('user')->latest()->paginate($request->record)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        auth()->user()->customers()->create($request->validated());
        return response()->json([
            "message"=>"Stored successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            "data"=>Customer::FindOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        auth()->user()->customers()->findorfail($id)->update($request->validated());
        return response()->json([
            "message"=>"Updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::FindOrFail($id)->delete();
        return response()->json([
            "message"=>"Deleted successfully"
        ]);
    }

    public function search(Request $request)
    {
        $data=Customer::query();

        $data->when($request->q,function($q) use($request){
            $q->where('name', 'LIKE','%'.$request->q.'%');
        });

        return response()->json([
            "data"=>$data->limit(20)->get()
        ]);
    }

}
