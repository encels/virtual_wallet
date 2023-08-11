<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use SimpleXMLElement;

trait SoapResponse
{
    public function getResponseXML($success, $message_error, $code_error, $data, Request $request)
    {  
    $segments= explode('\\', $request->route()[1]['uses']);
       $controllerName =end($segments);
        $controllerName = strstr($controllerName, '@', true);

       $url = $request->url();

        if (is_array($message_error)) :
            $message_error = implode(",", $message_error);
        endif;
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body></soap:Body></soap:Envelope>');
        $xml->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->registerXPathNamespace('xsd', 'http://www.w3.org/2001/XMLSchema');

        $body = $xml->xpath('//soap:Body')[0];
        $response = $body->addChild($controllerName.'Response', null, $url);
        $result = $response->addChild('result');

        $result->addChild('success', var_export($success,true), 'http://www.w3.org/2001/XMLSchema');
        $result->addChild('message_error', $message_error, 'http://www.w3.org/2001/XMLSchema');
        $result->addChild('code_error', $code_error, 'http://www.w3.org/2001/XMLSchema');
        $dataX= $result->addChild('data');

        foreach ($data as $key => $value) {
            $dataX->addChild($key, $value?:null, 'http://www.w3.org/2001/XMLSchema');
        }        
        
        $xml = $xml->asXML();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
