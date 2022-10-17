<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\Invoices;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class GetInvoicesRequest extends SaloonRequest
{
  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::GET;

  public function defineEndpoint(): string
  {
    return '/invoices';
  }

  public function defaultQuery(): array
  {
    return [
      'limit' => 1000,
      'offset' => 1,
      'search' => '',
      'dateFrom' => '',
      'dateTo' => '',
      'mode' => '',
      'showDetails' => '',
    ];
  }
}