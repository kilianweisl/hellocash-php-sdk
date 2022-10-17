<?php

namespace Weisl\HellocashPhpSdk\SDK\Requests\Articles;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class GetArticleRequest extends SaloonRequest
{
  protected ?string $connector = HellocashConnector::class;
  protected ?string $method = Saloon::GET;

  public function __construct(private readonly int $id) {}

  public function defineEndpoint(): string
  {
    return '/articles/' . $this->id;
  }
}