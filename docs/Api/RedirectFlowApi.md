# belenka\Everifin\Client\RedirectFlowApi

All URIs are relative to https://pay.stage.everifin.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**generatePaymentLink()**](RedirectFlowApi.md#generatePaymentLink) | **POST** /api/v1/link | Generate Payment Link


## `generatePaymentLink()`

```php
generatePaymentLink($PaymentLinkData): \belenka\Everifin\Client\Model\InlineResponse2007
```

Generate Payment Link

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$token = $response->getAccessToken(); // Response from getClientAccessToken

$configuration = new \belenka\Everifin\Client\Configuration();
$configuration->setHost('https://pay.stage.everifin.com');
$configuration->setAccessToken($token);

$client = new \GuzzleHttp\Client();

$apiInstance = new \belenka\Everifin\Client\Api\RedirectFlowApi($client, $configuration);

$PaymentLinkData = new \belenka\Everifin\Client\Model\PaymentLinkData(); 

try {
    $result = $apiInstance->generatePaymentLink($PaymentLinkData);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RedirectFlowApi->generatePaymentLink: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **PaymentLinkData** | [**\belenka\Everifin\Client\Model\PaymentLinkData**](../Model/PaymentLinkData.md)|  | [optional]

### Return type

[**\belenka\Everifin\Client\Model\InlineResponse2007**](../Model/InlineResponse2007.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
