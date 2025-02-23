<?php

namespace App\Http\Controllers\Api;

use App\Filters\InvoiceFilter;
use App\Models\Invoices;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoicesRequest;
use App\Http\Requests\UpdateInvoicesRequest;
use App\Http\Resources\InvoicesCollection;
use App\Http\Resources\InvoicesResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new InvoiceFilter();
        $queryItems = $filter->transform($request);
        $sortByType = $request->query('sortByType');
        $sortByName = $request->query('sortByName');
        $invoices = Invoices::where($queryItems);

        if ($sortByType && $sortByName) {
            $invoices = $invoices->orderBy($sortByName, $sortByType);
        }


        return new InvoicesCollection($invoices->paginate(30)->appends($request->query()));


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
    public function store(StoreInvoicesRequest $request)
    {
        //
        return new InvoicesResource(Invoices::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices $invoice)
    {

        return new InvoicesResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoicesRequest $request, Invoices $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices $invoice)
    {
        //
    }
}
