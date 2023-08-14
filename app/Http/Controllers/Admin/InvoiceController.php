<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data=Invoice::query();

        $data->when($request->q,function($query) use($request){
            $query->whereHas('customer', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%');
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
    public function store(InvoiceRequest $request)
    {
        auth()->user()->invoices()->create($request->validated());
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
            "data"=>Invoice::with('customer')->FindOrFail($id)
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
    public function update(InvoiceRequest $request, string $id)
    {
        auth()->user()->invoices()->findorfail($id)->update($request->validated());
        return response()->json([
            "message"=>"Updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Invoice::FindOrFail($id)->delete();
        return response()->json([
            "message"=>"Deleted successfully"
        ]);
    }
}
