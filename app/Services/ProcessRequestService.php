<?php

namespace App\Services;

// use App\Models\Customer;

use App\Models\Customer;

class ProcessRequestService
{

    /**
     * Processing based on Action
     *
     * @param array|null $request_data
     * @param string $action
     * @param integer|null $customer_id
     * @return void
     */
    public function process(array $request_data=null, string $action, int $customer_id = null)
    {
        if($action == 'create') return $this->create($request_data);
        if($action == 'update' ) return $this->update($request_data, $customer_id);
        if($action == 'delete' ) return $this->delete($customer_id);
    }

    /**
     * Create Operation
     *
     * @param array $request_data
     * @return void
     */
    public function create(array $request_data)
    {
        return Customer::create($request_data);
    }

    /**
     * Update Operation
     *
     * @param array $request_data
     * @param integer $customer_id
     * @return void
     */
    public function update(array $request_data, int $customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();
        $customer->update($request_data);
        return $customer;
    }

    public function delete(int $customer_id)
    {
        return Customer::find($customer_id)->delete();
    }
 
}
