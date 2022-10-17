<?php

namespace Weisl\HellocashPhpSdk\SDK;

use Sammyjo20\Saloon\Http\Auth\BasicAuthenticator;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Interfaces\AuthenticatorInterface;

class HellocashConnector extends SaloonConnector
{
  public function __construct(
    private string $user,
    private string $pw
  ) {}

  public function defineBaseUrl(): string
  {
    return 'https://api.hellocash.business/api/v1';
  }
  
  public function defaultHeaders(): array
  {
    return [
      'Accept' => 'application/json',
    ];
  }
  
  public function defaultConfig(): array
  {
    return [
      'timeout' => 30,
    ];
  }

  public function defaultAuth(): ?AuthenticatorInterface
  {
    return new BasicAuthenticator($this->user, $this->pw);
  }
}
