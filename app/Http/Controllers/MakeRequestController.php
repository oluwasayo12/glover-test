<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeRequest;
use App\Services\MakeRequestService;
use Illuminate\Http\Request;
use App\Mail\RequestNotificationEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
            //for production, an Email JOB can be used for implementation
            $allAdmin = User::select('email')->get();
            $mail_data = ['message' => 'New Request Alert'];
            foreach ($allAdmin as  $admin) {
                Mail::to($admin->email)->send(new RequestNotificationEmail($mail_data));
            }
            
            return $this->successResponse('Request Initialized. Awaiting Approval');
        }else
        {
            return $this->badRequestAlert(('Unable to initialze request '));
        }
    }
}
