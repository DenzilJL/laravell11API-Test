<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Filters\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new CustomerFilter();
        $queryItems = $filter->transform($request);
        $includeInvoice = $request->query('includeInvoices');
        $sortType = $request->query('sortType');
        $sortBy = $request->query('sortBy');
        $customers = Customer::where($queryItems);
        if ($includeInvoice) {
            $customers = $customers->with('invoices');
        }
        if ($sortType && $sortBy) {
            $customers = $customers->orderBy($sortBy, $sortType);
        }
        return new CustomerCollection($customers->paginate(30)->appends($request->query()));

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
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoice = request()->query('includeInvoices');
        if ($includeInvoice) {
            new CustomerResource(resource: $customer->loadMissing('invoices'));
        }
        return new CustomerResource(resource: $customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
