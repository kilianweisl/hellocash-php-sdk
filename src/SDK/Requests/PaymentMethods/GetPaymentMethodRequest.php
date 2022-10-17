<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\PaymentMethods;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class GetPaymentMethodRequest extends SaloonRequest
{
  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::GET;

  public function __construct(private readonly int $id) {}

  public function defineEndpoint(): string
  {
    return '/paymentMethods/' . $this->id;
  }
}