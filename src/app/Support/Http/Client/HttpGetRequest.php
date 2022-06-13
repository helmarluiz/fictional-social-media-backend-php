<?php

declare(strict_types=1);

namespace App\Support\Http\Client;

use Exception;

class HttpGetRequest extends ClientRequestBase
{
    /**
     * @return HttpGetRequest
     * @throws Exception
     */
    public function request(): HttpGetRequest
    {
        /* Initialize a cURL session */
        $curl = curl_init();

        $url = sprintf("%s?%s", $this->getRequestUrl(), http_build_query($this->getRequestParameters()));

        /* Set an options for cURL transfer */
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

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
        $this->setBody(is_string($result) ? $result : '');

        if (curl_errno($curl)) {
            var_dump(curl_error($curl) . ' - ' . $url);
            throw new Exception(curl_error($curl));
        }

        /* Close a cURL session */
        curl_close($curl);


        return $this;
    }
}
