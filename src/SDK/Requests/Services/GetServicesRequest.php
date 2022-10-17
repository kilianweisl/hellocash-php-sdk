<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\Services;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class GetServicesRequest extends SaloonRequest
{
  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::GET;

  public function defineEndpoint(): string
  {
    return '/services';
  }

  public function defaultQuery(): array
  {
    return [
      'limit' => 250,
      'offset' => 1,
      'caid' => '', // int
    ];
  }
}