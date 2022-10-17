<?php

namespace Tests\Client\Resources;

use PHPUnit\Framework\TestCase;
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Http\MockResponse;
use Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException;
use Weisl\HellocashPhpSdk\Client\HellocashClient;
use Weisl\HellocashPhpSdk\Client\Resources\InvoiceResource;

class InvoiceResourceTest extends TestCase
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

    $this->simpleMockClient = new HellocashClient(
      'email@exmaple.com',
      'test',
      new MockClient([MockResponse::make()])
    );
  }

  /** @test */
  function it_can_be_instantiated(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');

    // Act
    $resource = new InvoiceResource($client);
    
    // Assert
    $this->assertInstanceOf(InvoiceResource::class, $resource);
  }

  /** @test */
  public function it_can_fetch_all_invoices(): void
  {
    // Arrange
    $mockClient = new MockClient([
      MockResponse::make($this->json('Client/Resources/Invoices/GetInvoicesRequestStub1.json'), 200),
      MockResponse::make($this->json('Client/Resources/Invoices/GetInvoicesRequestStub2.json'), 200),
      MockResponse::make($this->json('Client/Resources/Invoices/GetInvoicesRequestStub3.json'), 200),
      MockResponse::make($this->json('Client/Resources/Invoices/GetInvoicesRequestStub4.json'), 200),
    ]);

    $client = new HellocashClient('email@exmaple.com', 'test', $mockClient);
    $resource = new InvoiceResource($client);

    // Act
    $invoices = $resource->all();
    
    // Assert
    $this->assertSame('87295092', $invoices[2]['invoice_id']);
    $this->assertCount(3, $invoices);
  }

  /** @test */
  public function it_can_handle_unsupported_parameter_for_query_method(): void
  {
    // Arrange
    $resource = new InvoiceResource($this->simpleMockClient);
    $this->expectException(SDKRequestFailedException::class);
    $this->expectExceptionMessage('parameterNotSupported is not supported');

    // Act
    $resource->query(['parameterNotSupported' => 10]);
    
    // Assert
  }

  /** @test */
  public function it_can_handle_wrong_typed_parameter_for_query_method(): void
  {
    // Arrange
    $resource = new InvoiceResource($this->simpleMockClient);
    $this->expectException(SDKRequestFailedException::class);
    $this->expectExceptionMessage('Value of limit must be of type integer');

    // Act
    $resource->query(['limit' => '10']);
    
    // Assert
  }

  /** @test */
  public function it_can_handle_wrong_typed_parameter_for_pdf_method(): void
  {
    // Arrange
    $resource = new InvoiceResource($this->simpleMockClient);
    $this->expectException(SDKRequestFailedException::class);
    $this->expectExceptionMessage('Value of cancellation must be of type boolean');

    // Act
    $resource->pdf(10, ['cancellation' => '10']);
    
    // Assert
  }

  /** @test */
  public function it_can_handle_wrong_typed_parameter_for_cancel_method(): void
  {
    // Arrange
    $resource = new InvoiceResource($this->simpleMockClient);
    $this->expectException(SDKRequestFailedException::class);
    $this->expectExceptionMessage('Value of cancellation_cashier_id must be of type integer|double');

    // Act
    $resource->cancel(10, ['cancellation_cashier_id' => '10']);
    
    // Assert
  }
}
