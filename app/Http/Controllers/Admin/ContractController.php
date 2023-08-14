<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContractRequest;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data=Contract::query();
        $data->where('customer_id',$request->customer_id);
        $data->when($request->q,function($q) use($request){
            $q->orWhere(function($query) use($request)
            {
                $query->where('name', 'LIKE','%'.$request->q.'%')->where('customer_id',$request->customer_id);
            })->orWhere(function($query) use($request)
            {
                $query->where('address', 'LIKE','%'.$request->q.'%')->where('customer_id',$request->customer_id);
            })->orWhere(function($query) use($request)
            {
                $query->where('phone_number', 'LIKE','%'.$request->q.'%')->where('customer_id',$request->customer_id);
            });
        });

        return response()->json([
            "data"=>$data->with('user','customer')->latest()->paginate($request->record)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContractRequest $request)
    {
        auth()->user()->contracts()->create($request->validated());
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
            "data"=>Contract::FindOrFail($id)
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
    public function update(ContractRequest $request, string $id)
    {
        auth()->user()->contracts()->findorfail($id)->update($request->validated());
        return response()->json([
            "message"=>"Updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contract::FindOrFail($id)->delete();
        return response()->json([
            "message"=>"Deleted successfully"
        ]);
    }
}
