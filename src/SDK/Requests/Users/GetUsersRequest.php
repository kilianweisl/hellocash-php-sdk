<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\Users;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class GetUsersRequest extends SaloonRequest
{
  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::GET;

  public function defineEndpoint(): string
  {
    return '/users';
  }

  public function defaultQuery(): array
  {
    return [
      'limit' => 250,
      'offset' => 1,
    ];
  }
}