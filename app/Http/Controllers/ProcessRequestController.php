<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessRequest;
use App\Models\Requests;
use App\Services\ProcessRequestService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProcessRequestController extends Controller
{
    /**
     * Approve Request
     *
     * @param ProcessRequest $request
     * @param ProcessRequestService $process_request_service
     * @return void
     */
    public function approve_request(ProcessRequest $request, ProcessRequestService $process_request_service): \Illuminate\Http\JsonResponse
    {
        try{
            if($request->request_action == 'approve')
            {
                $pending_request_data = Requests::findOrFail($request->request_id);

                $request_data = json_decode($pending_request_data->rq_data,true);
                $action = $pending_request_data->rq_type;
                $customer_id = $pending_request_data->customer_id;
                $processed_response = $process_request_service->process($request_data, $action, $customer_id );
                if($processed_response)
                {
                    $pending_request_data->delete();
                    return $this->successResponse('Request Approved.');
                }else
                {
                    return $this->badRequestAlert(('Unable to initialze request '));
                }
            }
        }catch(Exception $e)
        {
            Log::error($e->getMessage());
            return $this->badRequestAlert("Unable to process request");
        }

    }

    /**
     * Decline Request
     *
     * @param ProcessRequest $request
     * @return void
     */
    public function decline_request(ProcessRequest $request): \Illuminate\Http\JsonResponse
    {
        try{
            if($request->request_action == 'decline')
            {
                $pending_request_data = Requests::findOrFail($request->request_id);
                $pending_request_data->delete();
                return $this->successResponse('Request Declined.');
            }
        }catch(Exception $e)
        {
            Log::error($e->getMessage());
            return $this->badRequestAlert("Unable to process request");
        }

    }
}
