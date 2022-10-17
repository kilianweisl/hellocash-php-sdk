<?php

namespace Tests\Client\Resources;

use PHPUnit\Framework\TestCase;
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Http\MockResponse;
use Weisl\HellocashPhpSdk\Client\HellocashClient;
use Weisl\HellocashPhpSdk\Client\Resources\EmployeeResource;
use Weisl\HellocashPhpSdk\Client\Resources\PaymentMethodResource;

class PaymentMethodResourceTest extends TestCase
{
  private HellocashClient $simpleMockClient;

  private function json(string $file): string|false
  {
    return file_get_contents(
      __DIR__ . "/../../stubs/" . $file
    );
  }

  public function setUp(): void
  {
    parent::setUp();
  }

  /** @test */
  function it_can_be_instantiated(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');

    // Act
    $resource = new PaymentMethodResource($client);
    
    // Assert
    $this->assertInstanceOf(PaymentMethodResource::class, $resource);
  }

  /** @test */
  public function it_can_fetch_all_payment_methods(): void
  {
    // Arrange
    $mockClient = new MockClient([
      MockResponse::make($this->json('Client/Resources/PaymentMethods/GetPaymentMethodsRequestStub.json'), 200),
    ]);

    $client = new HellocashClient('email@exmaple.com', 'test', $mockClient);
    $resource = new EmployeeResource($client);

    // Act
    $employees = $resource->all();
    
    // Assert
    $this->assertSame('Bar', $employees[0]['paymentMethod_name']);
  }

  /** @test */
  public function it_can_fetch_one_payment_method(): void
  {
    // Arrange
    $mockClient = new MockClient([
      MockResponse::make($this->json('Client/Resources/PaymentMethods/GetPaymentMethodRequestStub.json'), 200),
    ]);

    $client = new HellocashClient('email@exmaple.com', 'test', $mockClient);
    $resource = new EmployeeResource($client);

    // Act
    $employees = $resource->all();
    
    // Assert
    $this->assertSame('Bar', $employees['paymentMethod_name']);
  }
}
