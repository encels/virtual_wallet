<?php

namespace App\Http\Controllers;

use App\Http\Traits\SoapResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Src\Users\Infrastructure\GetUser;
use Src\Users\Infrastructure\CreateUser;

class UserCreateControllerSOAP extends Controller

{
    use SoapResponse;

    private $controllerUser, $controllerGetUser;

    public function __construct(
        CreateUser $user,
        GetUser $getUser
    ) {
        $this->controllerUser = $user;
        $this->controllerGetUser = $getUser;
    }

    public function index(Request $request)
    {
        $error_code = '00';
        $error_msg ='';
        $validator = Validator::make($request->all(), [
            'document' => 'required',
            'fullName' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();

           return $this->getResponseXML(false, $errors, getenv('ERROR_VALIDATION'), [], $request);
    
        }
        $document = $request->input('document');
        $fullName = $request->input('fullName');
        $phone = $request->input('phone');
        $email = $request->input('email');
        try {
            $this->controllerUser->save($document, $fullName, $email, $phone);

            $data = $this->controllerGetUser->find($document, $phone);

            $success = true;
        } catch (\Exception $e) {
            $success = false;
            $error_msg = $e->getMessage();
            $error_code= (string)$e->getCode();
            $data = [];
        }


        return $this->getResponseXML($success, $error_msg, $error_code, $data, $request);
    }
}
