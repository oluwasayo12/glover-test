<?php

namespace App\Services;

use App\Models\Requests;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class MakeRequestService
{
    use ApiResponse;

    /**
     * Create New Request
     * can either by a create,update or delete request
     * @param array $request_data
     * @return void
     */
    public function create_request(array $request_data)
    {
       if(!empty($request_data['customer_data'])) $request_data['rq_data'] = json_encode($request_data['customer_data']);
        $request_data['rq_type'] = $request_data['customer_data_action'];
        return Requests::create($request_data);
    }
 
}
