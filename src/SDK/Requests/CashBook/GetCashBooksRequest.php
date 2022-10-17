<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\CashBook;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class GetCashBooksRequest extends SaloonRequest
{
  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::GET;

  public function defineEndpoint(): string
  {
    return '/cashBook';
  }

  public function defaultQuery(): array
  {
    return [
      'limit' => 1000,
      'offset' => 1,
      'dateFrom' => '',
      'dateTo' => '',
      'mode' => '',
    ];
  }
}