<?php

namespace Weisl\HellocashPhpSdk\Client\Resources;

use Weisl\HellocashPhpSdk\Client\HellocashClient;

class Resource
{
  public function __construct(protected HellocashClient $client) {}

  protected function validate(array $actual, array $supported): void
  {
    foreach ($actual as $key => $value) {
      if (!in_array($key, array_keys($supported))) {
        throw new \Exception($key . ' is not supported');
      }

      if (!in_array(gettype($value), explode('|', $supported[$key])))
      {
        throw new \Exception('Value of ' . $key . ' must be of type ' . $supported[$key]);
      }
    }
  }

  protected function errorResponse(string $message): array
  {
    return [
      'error' => $message
    ];
  }
}