<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Contact\SendContactRequest;
use App\Models\Contact;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponseTrait;

    public function store(SendContactRequest $request)
    {
        Contact::create($request->validated());
        return $this->apiResponse($request->validated(), 'Message Sent Successfully');
    }
}
