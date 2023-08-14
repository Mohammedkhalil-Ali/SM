<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceItemRequest;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data=InvoiceItem::query();

        $data->when($request->q,function($q) use($request){
            $q->orWhere(function($query) use($request)
            {
                $query->where('name', 'LIKE','%'.$request->q.'%');
            })->orWhere(function($query) use($request)
            {
                $query->where('price', 'LIKE','%'.$request->q.'%');
            })->orWhere(function($query) use($request)
            {
                $query->where('quantity', 'LIKE','%'.$request->q.'%');
            })->orWhere(function($query) use($request)
            {
                $query->where('subtotal', 'LIKE','%'.$request->q.'%');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceItemRequest $request)
    {
        auth()->user()->invoiceitems()->create($request->validated());
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
            "data"=>InvoiceItem::FindOrFail($id)
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
    public function update(InvoiceItemRequest $request, string $id)
    {
        auth()->user()->invoiceitems()->findorfail($id)->update($request->validated());
        return response()->json([
            "message"=>"Updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        InvoiceItem::FindOrFail($id)->delete();
        return response()->json([
            "message"=>"Deleted successfully"
            ]);
    }
}
