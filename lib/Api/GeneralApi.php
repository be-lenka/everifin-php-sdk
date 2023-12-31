<?php
/**
 * GeneralApi
 * PHP version 7.3
 *
 * @category Class
 * @package  belenka\Everifin\Client
 */
namespace belenka\Everifin\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use belenka\Everifin\Client\ApiException;
use belenka\Everifin\Client\Configuration;
use belenka\Everifin\Client\HeaderSelector;
use belenka\Everifin\Client\ObjectSerializer;

/**
 * GeneralApi Class Doc Comment
 *
 * @category Class
 * @package  belenka\Everifin\Client
 */
class GeneralApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getClientAccessToken
     *
     * Get Client Access Token
     *
     * @param  string $client_id client_id (optional)
     * @param  string $client_secret client_secret (optional)
     * @param  string $grant_type grant_type (optional)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \belenka\Everifin\Client\Model\InlineResponse200|\belenka\Everifin\Client\Model\InlineResponse400
     */
    public function getClientAccessToken($client_id = null, $client_secret = null, $grant_type = null)
    {
        list($response) = $this->getClientAccessTokenWithHttpInfo($client_id, $client_secret, $grant_type);
        return $response;
    }

    /**
     * Operation getClientAccessTokenWithHttpInfo
     *
     * Get Client Access Token
     *
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
     * @param  string $grant_type (optional)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \belenka\Everifin\Client\Model\InlineResponse200|\belenka\Everifin\Client\Model\InlineResponse400, HTTP status code, HTTP response headers (array of strings)
     */
    public function getClientAccessTokenWithHttpInfo($client_id = null, $client_secret = null, $grant_type = null)
    {
        $request = $this->getClientAccessTokenRequest($client_id, $client_secret, $grant_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\belenka\Everifin\Client\Model\InlineResponse200' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse200', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\belenka\Everifin\Client\Model\InlineResponse400' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse400', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\belenka\Everifin\Client\Model\InlineResponse200';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse200',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse400',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getClientAccessTokenAsync
     *
     * Get Client Access Token
     *
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
     * @param  string $grant_type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getClientAccessTokenAsync($client_id = null, $client_secret = null, $grant_type = null)
    {
        return $this->getClientAccessTokenAsyncWithHttpInfo($client_id, $client_secret, $grant_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getClientAccessTokenAsyncWithHttpInfo
     *
     * Get Client Access Token
     *
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
     * @param  string $grant_type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getClientAccessTokenAsyncWithHttpInfo($client_id = null, $client_secret = null, $grant_type = null)
    {
        $returnType = '\belenka\Everifin\Client\Model\InlineResponse200';
        $request = $this->getClientAccessTokenRequest($client_id, $client_secret, $grant_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getClientAccessToken'
     *
     * @param  string $client_id (optional)
     * @param  string $client_secret (optional)
     * @param  string $grant_type (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getClientAccessTokenRequest($client_id = null, $client_secret = null, $grant_type = null)
    {

        $resourcePath = '/auth/realms/everifin_paygate/protocol/openid-connect/token';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // form params
        if ($client_id !== null) {
            $formParams['client_id'] = ObjectSerializer::toFormValue($client_id);
        }
        // form params
        if ($client_secret !== null) {
            $formParams['client_secret'] = ObjectSerializer::toFormValue($client_secret);
        }
        // form params
        if ($grant_type !== null) {
            $formParams['grant_type'] = ObjectSerializer::toFormValue($grant_type);
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/x-www-form-urlencoded']
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        if ($this->config->getAccessToken()) {
            $defaultHeaders['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getClientBanks
     *
     * Get Client Banks
     *
     * @param  string $country_code Alpha 3 country code (optional)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \belenka\Everifin\Client\Model\InlineResponse2001|\belenka\Everifin\Client\Model\InlineResponse401
     */
    public function getClientBanks($country_code = null)
    {
        list($response) = $this->getClientBanksWithHttpInfo($country_code);
        return $response;
    }

    /**
     * Operation getClientBanksWithHttpInfo
     *
     * Get Client Banks
     *
     * @param  string $country_code Alpha 3 country code (optional)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \belenka\Everifin\Client\Model\InlineResponse2001|\belenka\Everifin\Client\Model\InlineResponse401, HTTP status code, HTTP response headers (array of strings)
     */
    public function getClientBanksWithHttpInfo($country_code = null)
    {
        $request = $this->getClientBanksRequest($country_code);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\belenka\Everifin\Client\Model\InlineResponse2001' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse2001', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\belenka\Everifin\Client\Model\InlineResponse401' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse401', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\belenka\Everifin\Client\Model\InlineResponse2001';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse2001',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse401',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getClientBanksAsync
     *
     * Get Client Banks
     *
     * @param  string $country_code Alpha 3 country code (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getClientBanksAsync($country_code = null)
    {
        return $this->getClientBanksAsyncWithHttpInfo($country_code)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getClientBanksAsyncWithHttpInfo
     *
     * Get Client Banks
     *
     * @param  string $country_code Alpha 3 country code (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getClientBanksAsyncWithHttpInfo($country_code = null)
    {
        $returnType = '\belenka\Everifin\Client\Model\InlineResponse2001';
        $request = $this->getClientBanksRequest($country_code);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getClientBanks'
     *
     * @param  string $country_code Alpha 3 country code (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getClientBanksRequest($country_code = null)
    {
        $resourcePath = '/api/v1/banks';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($country_code !== null) {
            if(is_array($country_code)) {
                foreach($country_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['countryCode'] = $country_code;
            }
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        if ($this->config->getAccessToken()) {
            $defaultHeaders['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getPaymentDetail
     *
     * Get payment detail
     *
     * @param  string $id id (required)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \belenka\Everifin\Client\Model\InlineResponse2004|\belenka\Everifin\Client\Model\InlineResponse401
     */
    public function getPaymentDetail($id)
    {
        list($response) = $this->getPaymentDetailWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation getPaymentDetailWithHttpInfo
     *
     * Get payment detail
     *
     * @param  string $id (required)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \belenka\Everifin\Client\Model\InlineResponse2004|\belenka\Everifin\Client\Model\InlineResponse401, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPaymentDetailWithHttpInfo($id)
    {
        $request = $this->getPaymentDetailRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\belenka\Everifin\Client\Model\InlineResponse2004' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse2004', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\belenka\Everifin\Client\Model\InlineResponse401' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse401', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\belenka\Everifin\Client\Model\InlineResponse2004';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse2004',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse401',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPaymentDetailAsync
     *
     * Get payment detail
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPaymentDetailAsync($id)
    {
        return $this->getPaymentDetailAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPaymentDetailAsyncWithHttpInfo
     *
     * Get payment detail
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPaymentDetailAsyncWithHttpInfo($id)
    {
        $returnType = '\belenka\Everifin\Client\Model\InlineResponse2004';
        $request = $this->getPaymentDetailRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getPaymentDetail'
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getPaymentDetailRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getPaymentDetail'
            );
        }

        $resourcePath = '/api/v1/payments/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        if ($this->config->getAccessToken()) {
            $defaultHeaders['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getPayments
     *
     * Get payments
     *
     * @param  string $page page (optional)
     * @param  string $count_per_page count_per_page (optional)
     * @param  string $sort sort (optional)
     * @param  string $id id (optional)
     * @param  string $instruction_id instruction_id (optional)
     * @param  string $recipient_iban recipient_iban (optional)
     * @param  string $sender_bank_id sender_bank_id (optional)
     * @param  string $amount amount (optional)
     * @param  string $currency currency (optional)
     * @param  string $variable_symbol variable_symbol (optional)
     * @param  string $specific_symbol specific_symbol (optional)
     * @param  string $constant_symbol constant_symbol (optional)
     * @param  string $reference reference (optional)
     * @param  string $payment_message payment_message (optional)
     * @param  string $status status (optional)
     * @param  string $step step (optional)
     * @param  string $redirect_url redirect_url (optional)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \belenka\Everifin\Client\Model\InlineResponse2002|\belenka\Everifin\Client\Model\InlineResponse401
     */
    public function getPayments($page = null, $count_per_page = null, $sort = null, $id = null, $instruction_id = null, $recipient_iban = null, $sender_bank_id = null, $amount = null, $currency = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $reference = null, $payment_message = null, $status = null, $step = null, $redirect_url = null)
    {
        list($response) = $this->getPaymentsWithHttpInfo($page, $count_per_page, $sort, $id, $instruction_id, $recipient_iban, $sender_bank_id, $amount, $currency, $variable_symbol, $specific_symbol, $constant_symbol, $reference, $payment_message, $status, $step, $redirect_url);
        return $response;
    }

    /**
     * Operation getPaymentsWithHttpInfo
     *
     * Get payments
     *
     * @param  string $page (optional)
     * @param  string $count_per_page (optional)
     * @param  string $sort (optional)
     * @param  string $id (optional)
     * @param  string $instruction_id (optional)
     * @param  string $recipient_iban (optional)
     * @param  string $sender_bank_id (optional)
     * @param  string $amount (optional)
     * @param  string $currency (optional)
     * @param  string $variable_symbol (optional)
     * @param  string $specific_symbol (optional)
     * @param  string $constant_symbol (optional)
     * @param  string $reference (optional)
     * @param  string $payment_message (optional)
     * @param  string $status (optional)
     * @param  string $step (optional)
     * @param  string $redirect_url (optional)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \belenka\Everifin\Client\Model\InlineResponse2002|\belenka\Everifin\Client\Model\InlineResponse401, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPaymentsWithHttpInfo($page = null, $count_per_page = null, $sort = null, $id = null, $instruction_id = null, $recipient_iban = null, $sender_bank_id = null, $amount = null, $currency = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $reference = null, $payment_message = null, $status = null, $step = null, $redirect_url = null)
    {
        $request = $this->getPaymentsRequest($page, $count_per_page, $sort, $id, $instruction_id, $recipient_iban, $sender_bank_id, $amount, $currency, $variable_symbol, $specific_symbol, $constant_symbol, $reference, $payment_message, $status, $step, $redirect_url);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\belenka\Everifin\Client\Model\InlineResponse2002' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse2002', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\belenka\Everifin\Client\Model\InlineResponse401' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse401', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\belenka\Everifin\Client\Model\InlineResponse2002';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse2002',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse401',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPaymentsAsync
     *
     * Get payments
     *
     * @param  string $page (optional)
     * @param  string $count_per_page (optional)
     * @param  string $sort (optional)
     * @param  string $id (optional)
     * @param  string $instruction_id (optional)
     * @param  string $recipient_iban (optional)
     * @param  string $sender_bank_id (optional)
     * @param  string $amount (optional)
     * @param  string $currency (optional)
     * @param  string $variable_symbol (optional)
     * @param  string $specific_symbol (optional)
     * @param  string $constant_symbol (optional)
     * @param  string $reference (optional)
     * @param  string $payment_message (optional)
     * @param  string $status (optional)
     * @param  string $step (optional)
     * @param  string $redirect_url (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPaymentsAsync($page = null, $count_per_page = null, $sort = null, $id = null, $instruction_id = null, $recipient_iban = null, $sender_bank_id = null, $amount = null, $currency = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $reference = null, $payment_message = null, $status = null, $step = null, $redirect_url = null)
    {
        return $this->getPaymentsAsyncWithHttpInfo($page, $count_per_page, $sort, $id, $instruction_id, $recipient_iban, $sender_bank_id, $amount, $currency, $variable_symbol, $specific_symbol, $constant_symbol, $reference, $payment_message, $status, $step, $redirect_url)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPaymentsAsyncWithHttpInfo
     *
     * Get payments
     *
     * @param  string $page (optional)
     * @param  string $count_per_page (optional)
     * @param  string $sort (optional)
     * @param  string $id (optional)
     * @param  string $instruction_id (optional)
     * @param  string $recipient_iban (optional)
     * @param  string $sender_bank_id (optional)
     * @param  string $amount (optional)
     * @param  string $currency (optional)
     * @param  string $variable_symbol (optional)
     * @param  string $specific_symbol (optional)
     * @param  string $constant_symbol (optional)
     * @param  string $reference (optional)
     * @param  string $payment_message (optional)
     * @param  string $status (optional)
     * @param  string $step (optional)
     * @param  string $redirect_url (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPaymentsAsyncWithHttpInfo($page = null, $count_per_page = null, $sort = null, $id = null, $instruction_id = null, $recipient_iban = null, $sender_bank_id = null, $amount = null, $currency = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $reference = null, $payment_message = null, $status = null, $step = null, $redirect_url = null)
    {
        $returnType = '\belenka\Everifin\Client\Model\InlineResponse2002';
        $request = $this->getPaymentsRequest($page, $count_per_page, $sort, $id, $instruction_id, $recipient_iban, $sender_bank_id, $amount, $currency, $variable_symbol, $specific_symbol, $constant_symbol, $reference, $payment_message, $status, $step, $redirect_url);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getPayments'
     *
     * @param  string $page (optional)
     * @param  string $count_per_page (optional)
     * @param  string $sort (optional)
     * @param  string $id (optional)
     * @param  string $instruction_id (optional)
     * @param  string $recipient_iban (optional)
     * @param  string $sender_bank_id (optional)
     * @param  string $amount (optional)
     * @param  string $currency (optional)
     * @param  string $variable_symbol (optional)
     * @param  string $specific_symbol (optional)
     * @param  string $constant_symbol (optional)
     * @param  string $reference (optional)
     * @param  string $payment_message (optional)
     * @param  string $status (optional)
     * @param  string $step (optional)
     * @param  string $redirect_url (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getPaymentsRequest($page = null, $count_per_page = null, $sort = null, $id = null, $instruction_id = null, $recipient_iban = null, $sender_bank_id = null, $amount = null, $currency = null, $variable_symbol = null, $specific_symbol = null, $constant_symbol = null, $reference = null, $payment_message = null, $status = null, $step = null, $redirect_url = null)
    {

        $resourcePath = '/api/v1/payments';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($count_per_page !== null) {
            if('form' === 'form' && is_array($count_per_page)) {
                foreach($count_per_page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['countPerPage'] = $count_per_page;
            }
        }
        // query params
        if ($sort !== null) {
            if('form' === 'form' && is_array($sort)) {
                foreach($sort as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['sort'] = $sort;
            }
        }
        // query params
        if ($id !== null) {
            if('form' === 'form' && is_array($id)) {
                foreach($id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['id'] = $id;
            }
        }
        // query params
        if ($instruction_id !== null) {
            if('form' === 'form' && is_array($instruction_id)) {
                foreach($instruction_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['instructionId'] = $instruction_id;
            }
        }
        // query params
        if ($recipient_iban !== null) {
            if('form' === 'form' && is_array($recipient_iban)) {
                foreach($recipient_iban as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['recipientIban'] = $recipient_iban;
            }
        }
        // query params
        if ($sender_bank_id !== null) {
            if('form' === 'form' && is_array($sender_bank_id)) {
                foreach($sender_bank_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['senderBankId'] = $sender_bank_id;
            }
        }
        // query params
        if ($amount !== null) {
            if('form' === 'form' && is_array($amount)) {
                foreach($amount as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['amount'] = $amount;
            }
        }
        // query params
        if ($currency !== null) {
            if('form' === 'form' && is_array($currency)) {
                foreach($currency as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['currency'] = $currency;
            }
        }
        // query params
        if ($variable_symbol !== null) {
            if('form' === 'form' && is_array($variable_symbol)) {
                foreach($variable_symbol as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['variableSymbol'] = $variable_symbol;
            }
        }
        // query params
        if ($specific_symbol !== null) {
            if('form' === 'form' && is_array($specific_symbol)) {
                foreach($specific_symbol as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['specificSymbol'] = $specific_symbol;
            }
        }
        // query params
        if ($constant_symbol !== null) {
            if('form' === 'form' && is_array($constant_symbol)) {
                foreach($constant_symbol as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['constantSymbol'] = $constant_symbol;
            }
        }
        // query params
        if ($reference !== null) {
            if('form' === 'form' && is_array($reference)) {
                foreach($reference as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['reference'] = $reference;
            }
        }
        // query params
        if ($payment_message !== null) {
            if('form' === 'form' && is_array($payment_message)) {
                foreach($payment_message as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['paymentMessage'] = $payment_message;
            }
        }
        // query params
        if ($status !== null) {
            if('form' === 'form' && is_array($status)) {
                foreach($status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['status[]'] = $status;
            }
        }
        // query params
        if ($step !== null) {
            if('form' === 'form' && is_array($step)) {
                foreach($step as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['step[]'] = $step;
            }
        }
        // query params
        if ($redirect_url !== null) {
            if('form' === 'form' && is_array($redirect_url)) {
                foreach($redirect_url as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['redirectUrl'] = $redirect_url;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        if ($this->config->getAccessToken()) {
            $defaultHeaders['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation withdrawPayment
     *
     * Withdraw payment
     *
     * @param  string $id id (required)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \belenka\Everifin\Client\Model\InlineResponse2005|\belenka\Everifin\Client\Model\InlineResponse4002|\belenka\Everifin\Client\Model\InlineResponse401
     */
    public function withdrawPayment($id)
    {
        list($response) = $this->withdrawPaymentWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation withdrawPaymentWithHttpInfo
     *
     * Withdraw payment
     *
     * @param  string $id (required)
     *
     * @throws \belenka\Everifin\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \belenka\Everifin\Client\Model\InlineResponse2005|\belenka\Everifin\Client\Model\InlineResponse4002|\belenka\Everifin\Client\Model\InlineResponse401, HTTP status code, HTTP response headers (array of strings)
     */
    public function withdrawPaymentWithHttpInfo($id)
    {
        $request = $this->withdrawPaymentRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\belenka\Everifin\Client\Model\InlineResponse2005' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse2005', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\belenka\Everifin\Client\Model\InlineResponse4002' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse4002', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\belenka\Everifin\Client\Model\InlineResponse401' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\belenka\Everifin\Client\Model\InlineResponse401', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\belenka\Everifin\Client\Model\InlineResponse2005';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse2005',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse4002',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\belenka\Everifin\Client\Model\InlineResponse401',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation withdrawPaymentAsync
     *
     * Withdraw payment
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function withdrawPaymentAsync($id)
    {
        return $this->withdrawPaymentAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation withdrawPaymentAsyncWithHttpInfo
     *
     * Withdraw payment
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function withdrawPaymentAsyncWithHttpInfo($id)
    {
        $returnType = '\belenka\Everifin\Client\Model\InlineResponse2005';
        $request = $this->withdrawPaymentRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'withdrawPayment'
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function withdrawPaymentRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling withdrawPayment'
            );
        }

        $resourcePath = '/api/v1/payments/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        if ($this->config->getAccessToken()) {
            $defaultHeaders['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
