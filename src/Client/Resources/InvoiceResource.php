<?php

namespace Weisl\HellocashPhpSdk\Client\Resources;

use Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException;
use Weisl\HellocashPhpSdk\Interfaces\Resources\InvoiceResourceInterface;
use Weisl\HellocashPhpSdk\SDK\Requests\Invoices\CancelInvoiceRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Invoices\CreateInvoiceRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Invoices\GetInvoiceAsPdfRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Invoices\GetInvoiceRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Invoices\GetInvoicesRequest;

class InvoiceResource extends Resource implements InvoiceResourceInterface
{
  public function all(): array
  {
    try {
      $invoices = [];

      $response = $this->client->connector->send(new GetInvoicesRequest())->json();
      foreach($response['invoices'] as $invoice) {
        array_push($invoices, $invoice);
      }

      if($response['count'] > $response['limit']) {
        $offset = 1;
        while(!empty($response['invoices'])) {
          $request = new GetInvoicesRequest();
          $request->mergeQuery(['offset' => ++$offset]);
          $response = $this->client->connector->send($request)->json();
          foreach($response['invoices'] as $invoice) {
            array_push($invoices, $invoice);
          }
        }
      }

      return $invoices;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function query(array $parameters): array
  {
    try {
      $supported = [
        'limit' => 'integer',
        'offset' => 'integer',
        'search' => 'string',
        'dateFrom' => 'string',
        'dateTo' => 'string',
        'mode' => 'string',
        'showDetails' => 'boolean'
      ];
      $this->validate($parameters, $supported);

      $request = new GetInvoicesRequest();
      $request->mergeQuery($parameters);
      $response = $this->client->connector->send($request)->json();

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function get(int $id): array
  {
    try {
      $response = $this->client->connector->send(new GetInvoiceRequest($id))->json();

      if($response === 'Invoice not found') {
        return $this->errorResponse('Invoice with ID ' . $id . ' not found.');
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function pdf(int $id, array $parameters = []): array
  {
    try {
      $supported = [
        'cancellation' => 'boolean',
      ];
      $this->validate($parameters, $supported);

      $request = new GetInvoiceAsPdfRequest($id);
      $request->mergeQuery($parameters);
      $response = $this->client->connector->send($request)->json();

      if(isset($response['error']) && $response['error'] === 'No invoice found') {
        return $this->errorResponse('Invoice with ID ' . $id . ' not found. If cancellation is true, the invoice might not be cancelled.');
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function create(array $body): mixed
  {
    try {
      $supported = [
        'cashier_id' => 'integer|double',
        'invoice_testMode' => 'boolean',
        'invoice_text' => 'string',
        'invoice_reference' => 'boolean',
        'invoice_paymentMethod' => 'string',
        'invoice_discount_percent' => 'integer|double',
        'invoice_user_id' => 'integer|double',
        'signature_mandatory' => 'boolean',
        'items' => 'array',
      ];
      $this->validate($body, $supported);

      $request = new CreateInvoiceRequest();
      $request->setData($body);
      $response = $this->client->connector->send($request)->json();

      if(isset($response['error'])) {
        return $this->errorResponse('Invoice could not be created. Error message from API: ' . $response['error']);
      }

      if(!isset($response['invoice_id'])) {
        return $this->errorResponse('Invoice could not be created. Error message from API: ' . $response);
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function cancel(int $id, array $body = []): array
  {
    try {
      $supported = [
        'cancellation_cashier_id' => 'integer|double',
        'cancellation_reason' => 'string',
        'cancellation_cashBook_entry' => 'boolean',
      ];
      $this->validate($body, $supported);

      $request = new CancelInvoiceRequest($id);
      $request->setData($body);
      $response = $this->client->connector->send($request)->json();

      if($response === 'An Error occurred') {
        return $this->errorResponse('Cancellation of Invoice with ' . $id . ' was not successful. API error message: An Error occurred');
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }
}
