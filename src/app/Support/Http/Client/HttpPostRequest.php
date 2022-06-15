<?php

declare(strict_types=1);

namespace App\Support\Http\Client;

use Exception;

class HttpPostRequest extends ClientRequestBase
{
    /**
     * @return HttpPostRequest
     * @throws Exception
     */
    public function request(): HttpPostRequest
    {
        /* Initialize a cURL session */
        $curl = curl_init();

        /* Set an options for cURL transfer */
        curl_setopt($curl, CURLOPT_URL, $this->getRequestUrl());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->getRequestParameters());

        /* Set Header Option */
        if ($this->getRequestHeaders()) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getRequestHeaders());
        }

        /* Perform cURL session */
        $result = curl_exec($curl);

        /* Get response status code */
        $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        /* Set internal attributes */
        $this->setStatusCode($httpStatusCode);
        $this->setBody($result);

        /* Close a cURL session */
        curl_close($curl);

        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }

        return $this;
    }
}
