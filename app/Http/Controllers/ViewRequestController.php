<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Requests;
use Illuminate\Http\Request;

class ViewRequestController extends Controller
{
    /**
     * View Pending Requests
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(): \Illuminate\Http\JsonResponse
    {
        $allPendingRequests = Requests::select('rq_id as request_id', 'customer_id as user_unique_idetifier','rq_type as request_type','rq_data as update_data',)->where('rq_status', 'Pending')->get();
        $pendingRequests = [];

        foreach($allPendingRequests as $pendings)
        {
            $pendings['user_unique_idetifier'] = Customer::where('customer_id',$pendings['user'])->value('firstname');
            $pendings['update_data'] = json_decode($pendings['update_data'],true);
            $pendingRequests[] = $pendings;
        }

        return $this->successResponse('All requests', $pendingRequests);
    }
}


