<?php

namespace Tests\Client;

use PHPUnit\Framework\TestCase;
use Weisl\HellocashPhpSdk\Client\HellocashClient;
use Weisl\HellocashPhpSdk\Client\Resources\ArticleResource;
use Weisl\HellocashPhpSdk\Client\Resources\CashBookResource;
use Weisl\HellocashPhpSdk\Client\Resources\EmployeeResource;
use Weisl\HellocashPhpSdk\Client\Resources\InvoiceResource;
use Weisl\HellocashPhpSdk\Client\Resources\PaymentMethodResource;
use Weisl\HellocashPhpSdk\Client\Resources\ServiceResource;
use Weisl\HellocashPhpSdk\Client\Resources\UserResource;

class HellocashClientTest extends TestCase
{
  /** @test */
  function it_can_be_instantiated(): void
  {
    // Arrange
    // Act
    $client = new HellocashClient('email@exmaple.com', 'test');
    
    // Assert
    $this->assertInstanceOf(HellocashClient::class, $client);
  }

  /** @test */
  function it_can_return_invoice_resource(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');
    
    // Act
    $invoices = $client->invoices();

    // Assert
    $this->assertInstanceOf(InvoiceResource::class, $invoices);
  }

  /** @test */
  function it_can_return_employee_resource(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');
    
    // Act
    $employees = $client->employees();

    // Assert
    $this->assertInstanceOf(EmployeeResource::class, $employees);
  }

  /** @test */
  function it_can_return_payment_methods_resource(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');
    
    // Act
    $paymentMethods = $client->paymentMethods();

    // Assert
    $this->assertInstanceOf(PaymentMethodResource::class, $paymentMethods);
  }

  /** @test */
  function it_can_return_cash_book_resource(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');
    
    // Act
    $cashBook = $client->cashBook();

    // Assert
    $this->assertInstanceOf(CashBookResource::class, $cashBook);
  }

  /** @test */
  function it_can_return_articles_resource(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');
    
    // Act
    $articles = $client->articles();

    // Assert
    $this->assertInstanceOf(ArticleResource::class, $articles);
  }

  /** @test */
  function it_can_return_services_resource(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');
    
    // Act
    $services = $client->services();

    // Assert
    $this->assertInstanceOf(ServiceResource::class, $services);
  }

  /** @test */
  function it_can_return_users_resource(): void
  {
    // Arrange
    $client = new HellocashClient('email@exmaple.com', 'test');
    
    // Act
    $users = $client->users();

    // Assert
    $this->assertInstanceOf(UserResource::class, $users);
  }
}
