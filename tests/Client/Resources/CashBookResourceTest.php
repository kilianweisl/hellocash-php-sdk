<?php

namespace Tests\Client\Resources;

use PHPUnit\Framework\TestCase;
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Http\MockResponse;
use Weisl\HellocashPhpSdk\Client\HellocashClient;
use Weisl\HellocashPhpSdk\Client\Resources\CashBookResource;

class CashBookResourceTest extends TestCase
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
    $resource = new CashBookResource($client);
    
    // Assert
    $this->assertInstanceOf(CashBookResource::class, $resource);
  }

  /** @test */
  public function it_can_fetch_all_cashbook_entries(): void
  {
    // Arrange
    $mockClient = new MockClient([
      MockResponse::make($this->json('Client/Resources/CashBook/GetCashBookRequestStub.json'), 200),
    ]);

    $client = new HellocashClient('email@exmaple.com', 'test', $mockClient);
    $resource = new CashBookResource($client);

    // Act
    $cashBookEntries = $resource->all();
    
    // Assert
    $this->assertSame('72905826', $cashBookEntries[0]['cashBook_id']);
  }
}
