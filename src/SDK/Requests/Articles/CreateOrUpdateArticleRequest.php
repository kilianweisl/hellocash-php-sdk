<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\Articles;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class CreateOrUpdateArticleRequest extends SaloonRequest
{
  use HasJsonBody;

  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::POST;

  public function defineEndpoint(): string
  {
    return '/articles';
  }
}