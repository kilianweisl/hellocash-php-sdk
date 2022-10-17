<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\Invoices;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class GetInvoiceRequest extends SaloonRequest
{
  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::GET;

  public function __construct(private readonly int $id) {}

  public function defineEndpoint(): string
  {
    return '/invoices/' . $this->id;
  }
}