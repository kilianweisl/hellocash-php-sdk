<?php

namespace Tests\Client\Resources;

use PHPUnit\Framework\TestCase;
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Http\MockResponse;
use Weisl\HellocashPhpSdk\Client\HellocashClient;
use Weisl\HellocashPhpSdk\Client\Resources\ArticleResource;
use Weisl\HellocashPhpSdk\Client\Resources\UserResource;

class UserResourceTest extends TestCase
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
    $resource = new UserResource($client);
    
    // Assert
    $this->assertInstanceOf(UserResource::class, $resource);
  }

  /** @test */
  public function it_can_fetch_all_users(): void
  {
    // Arrange
    $mockClient = new MockClient([
      MockResponse::make($this->json('Client/Resources/Users/GetUsersRequestStub.json'), 200),
    ]);

    $client = new HellocashClient('email@exmaple.com', 'test', $mockClient);
    $resource = new UserResource($client);

    // Act
    $entries = $resource->all();
    
    // Assert
    $this->assertSame('Test', $entries[0]['user_firstname']);
  }
}
