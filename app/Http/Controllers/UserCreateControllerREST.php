<?php

namespace App\Http\Controllers;

use App\Http\Traits\CallService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserCreateControllerREST extends Controller

{
    use CallService;

    protected $method;
    protected $endpoint;

    public function __construct()
    {
        $this->method = "POST";
        $this->endpoint = getenv('URL_SOAP') . '/users';
    }

    public function index(Request $request)
    {

        $document = $request->input('document');
        $fullName = $request->input('fullName');
        $phone = $request->input('phone');
        $email = $request->input('email');
        try {

            $responseSOAP = $this->callService(
                $this->method,
                $this->endpoint,
                [
                    'document' => $document,
                    'fullName' => $fullName,
                    'email' => $email,
                    'phone' => $phone
                ]
            );

            return response()->json($responseSOAP, 201);
        } catch (\Exception $e) {
            $success = false;
            $error_msg = $e->getMessage();
            $error_code = (string)$e->getCode();
        }


        return response()->json([
            'success' => $success,
            'message_error' => $error_msg,
            'code_error' => $error_code,
        ], 200);
    }
}
