<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;


trait CallService
{
    use Utils;
    protected function callService(string $method, string $endpoint, array $params): array
    {


        $response = Http::$method($endpoint, $params);


        $dom = new \DOMDocument();
        $dom->loadXML($response->body());

        $result = $dom->getElementsByTagName('result')[0];

        $data = [];

        foreach ($result->getElementsByTagName('*') as $node) {

            if ($node->nodeName != 'data') {
                if ($node->parentNode->nodeName == 'data') {
                    $data['data'][$node->nodeName] = $this->convertToType($node->nodeValue);
                } else {
                    $data[$node->nodeName] = $this->convertToType($node->nodeValue);
                }
            } else {
            }
        }



        return $data;
    }

    
}
