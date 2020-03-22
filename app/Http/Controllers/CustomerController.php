<?php

namespace App\Http\Controllers;

use App\DbModels\Customer;
use App\Http\Requests\Customer\IndexRequest;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerResourceCollection;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Auth\Access\AuthorizationException;

class CustomerController extends Controller
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * CustomerController constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CustomerResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Customer::class, $request->input('propertyId')]);

        $customers = $this->customerRepository->findBy($request->all());

        return new CustomerResourceCollection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CustomerResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Customer::class, $request->input('propertyId')]);

        $customer = $this->customerRepository->save($request->all());

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return CustomerResource
     * @throws AuthorizationException
     */
    public function show(Customer $customer)
    {
        $this->authorize('show', $customer);

        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Customer $customer
     * @return CustomerResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $customer = $this->customerRepository->update($customer, $request->all());

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('destroy', $customer);

        $this->customerRepository->delete($customer);

        return response()->json(null, 204);
    }
}
