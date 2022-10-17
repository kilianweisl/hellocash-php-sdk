<?php

namespace Tests\Client\Resources;

use PHPUnit\Framework\TestCase;
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Http\MockResponse;
use Weisl\HellocashPhpSdk\Client\HellocashClient;
use Weisl\HellocashPhpSdk\Client\Resources\EmployeeResource;
use Weisl\HellocashPhpSdk\Client\Resources\InvoiceResource;

class EmployeeResourceTest extends TestCase
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
    $resource = new EmployeeResource($client);
    
    // Assert
    $this->assertInstanceOf(EmployeeResource::class, $resource);
  }

  /** @test */
  public function it_can_fetch_all_employees(): void
  {
    // Arrange
    $mockClient = new MockClient([
      MockResponse::make($this->json('Client/Resources/Employees/GetEmployeesRequestStub.json'), 200),
    ]);

    $client = new HellocashClient('email@exmaple.com', 'test', $mockClient);
    $resource = new EmployeeResource($client);

    // Act
    $employees = $resource->all();
    
    // Assert
    $this->assertSame('Kassier', $employees[0]['employee_name']);
  }

  /** @test */
  public function it_can_fetch_one_employee(): void
  {
    // Arrange
    $mockClient = new MockClient([
      MockResponse::make($this->json('Client/Resources/Employees/GetEmployeeRequestStub.json'), 200),
    ]);

    $client = new HellocashClient('email@exmaple.com', 'test', $mockClient);
    $resource = new EmployeeResource($client);

    // Act
    $employees = $resource->all();
    
    // Assert
    $this->assertSame('Kassier', $employees['employee_name']);
  }
}
