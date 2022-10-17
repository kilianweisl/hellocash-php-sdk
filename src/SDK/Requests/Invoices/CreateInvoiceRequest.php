<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\Invoices;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class CreateInvoiceRequest extends SaloonRequest
{
  use HasJsonBody;

  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::POST;

  public function defineEndpoint(): string
  {
    return '/invoices';
  }
}