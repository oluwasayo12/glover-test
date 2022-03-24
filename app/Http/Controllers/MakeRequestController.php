<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeRequest;
use App\Services\MakeRequestService;
use Illuminate\Http\Request;

class MakeRequestController extends Controller
{
    /**
     * Iitialize a new request to either create, update or delete a user info
     *
     * @param MakeRequest $request
     * @param MakeRequestService $make_request_service
     * @return : \Illuminate\Http\JsonResponse
     */
    public function make_request(MakeRequest $request, MakeRequestService $make_request_service): \Illuminate\Http\JsonResponse
    {
        $make_request = $make_request_service->create_request($request->validated());
        if($make_request)
        {
            return $this->successResponse('Request Initialized. Awaiting Approval');
        }else
        {
            return $this->badRequestAlert(('Unable to initialze request '));
        }
    }
}
