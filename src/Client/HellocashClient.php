<?php

namespace Weisl\HellocashPhpSdk\Client;

use Sammyjo20\Saloon\Clients\MockClient;
use Weisl\HellocashPhpSdk\Client\Resources\ArticleResource;
use Weisl\HellocashPhpSdk\Client\Resources\CashBookResource;
use Weisl\HellocashPhpSdk\Client\Resources\EmployeeResource;
use Weisl\HellocashPhpSdk\Client\Resources\InvoiceResource;
use Weisl\HellocashPhpSdk\Client\Resources\PaymentMethodResource;
use Weisl\HellocashPhpSdk\Client\Resources\ServiceResource;
use Weisl\HellocashPhpSdk\Client\Resources\UserResource;
use Weisl\HellocashPhpSdk\Interfaces\HellocashClientInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\ArticleResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\CashBookResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\EmployeeResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\InvoiceResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\PaymentMethodResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\ServiceResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\UserResourceInterface;
use Weisl\HellocashPhpSdk\SDK\HellocashConnector;

class HellocashClient implements HellocashClientInterface
{
  public readonly HellocashConnector $connector;

  public function __construct(
    private string $user,
    private string $pw,
    MockClient $mockClient = null
  ) {
    $this->connector = new HellocashConnector($this->user, $this->pw);

    if($mockClient) {
      $this->connector->withMockClient($mockClient);
    }
  }

  public function invoices(): InvoiceResourceInterface
  {
    return new InvoiceResource($this);
  }

  public function employees(): EmployeeResourceInterface
  {
    return new EmployeeResource($this);
  }

  public function paymentMethods(): PaymentMethodResourceInterface
  {
    return new PaymentMethodResource($this);
  }

  public function cashBook(): CashBookResourceInterface
  {
    return new CashBookResource($this);
  }

  public function articles(): ArticleResourceInterface
  {
    return new ArticleResource($this);
  }

  public function services(): ServiceResourceInterface
  {
    return new ServiceResource($this);
  }

  public function users(): UserResourceInterface
  {
    return new UserResource($this);
  }
}
