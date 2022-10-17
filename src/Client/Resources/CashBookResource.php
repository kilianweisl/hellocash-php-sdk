<?php

namespace Weisl\HellocashPhpSdk\Client\Resources;

use Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException;
use Weisl\HellocashPhpSdk\Interfaces\Resources\CashBookResourceInterface;
use Weisl\HellocashPhpSdk\SDK\Requests\CashBook\CreateCashBookEntryRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\CashBook\GetCashBookSaldoRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\CashBook\GetCashBooksRequest;

class CashBookResource extends Resource implements CashBookResourceInterface
{
  public function all(): array
  {
    try {
      $entries = [];

      $response = $this->client->connector->send(new GetCashBooksRequest())->json();
      foreach($response['entries'] as $entry) {
        array_push($entries, $entry);
      }

      if($response['count'] > $response['limit']) {
        $offset = 1;
        while(!empty($response['entries'])) {
          $request = new GetCashBooksRequest();
          $request->mergeQuery(['offset' => ++$offset]);
          $response = $this->client->connector->send($request)->json();
          foreach($response['entries'] as $entry) {
            array_push($entries, $entry);
          }
        }
      }

      return $entries;
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
        'dateFrom' => 'string',
        'dateTo' => 'string',
        'mode' => 'string',
      ];
      $this->validate($parameters, $supported);

      $request = new GetCashBooksRequest();
      $request->mergeQuery($parameters);
      $response = $this->client->connector->send($request)->json();

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function saldo(array $parameters): array
  {
    try {
      $supported = [
        'mode' => 'string',
      ];
      $this->validate($parameters, $supported);

      $request = new GetCashBookSaldoRequest();
      $request->mergeQuery($parameters);
      $response = $this->client->connector->send($request)->json();

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function create(array $body): array
  {
    try {
      $supported = [
        'cashbook_testMode' => 'boolean',
        'cashbook_payment' => 'integer', // enum: 0 or 1
        'cashbook_amount_gross' => 'integer|double',
        'cashbook_amount_net' => 'integer|double',
        'cashbook_amount_tax' => 'integer|double',
        'cashbook_deliveryNumber' => 'string',
        'cashBook_description' => 'string',
        'cashbook_businessType' => 'integer', // enum: 1 or 2
      ];
      $this->validate($body, $supported);

      $request = new CreateCashBookEntryRequest();
      $request->setData($body);
      $response = $this->client->connector->send($request)->json();

      if(isset($response['error'])) {
        return $this->errorResponse('Cashbook entry could not be created. Error message from API: ' . $response['error']);
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }
}
