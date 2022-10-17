<?php

namespace Weisl\HellocashPhpSdk\Client\Resources;

use Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException;
use Weisl\HellocashPhpSdk\Interfaces\Resources\PaymentMethodResourceInterface;
use Weisl\HellocashPhpSdk\SDK\Requests\PaymentMethods\GetPaymentMethodRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\PaymentMethods\GetPaymentMethodsRequest;

class PaymentMethodResource extends Resource implements PaymentMethodResourceInterface
{
  public function all(): array
  {
    try {
      $response = $this->client->connector->send(new GetPaymentMethodsRequest())->json();

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function get(int $id): array
  {
    try {
      $response = $this->client->connector->send(new GetPaymentMethodRequest($id))->json();

      if($response === 'Payment method not found') {
        return $this->errorResponse('Payment method with ID ' . $id . ' not found.');
      }
      
      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }
}
