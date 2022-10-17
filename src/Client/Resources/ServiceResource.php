<?php

namespace Weisl\HellocashPhpSdk\Client\Resources;

use Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException;
use Weisl\HellocashPhpSdk\Interfaces\Resources\ServiceResourceInterface;
use Weisl\HellocashPhpSdk\SDK\Requests\Services\GetServiceRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Services\GetServicesRequest;

class ServiceResource extends Resource implements ServiceResourceInterface
{
  public function all(): array
  {
    try {
      $services = [];

      $response = $this->client->connector->send(new GetServicesRequest())->json();
      foreach($response['services'] as $entry) {
        array_push($services, $entry);
      }

      if($response['count'] > $response['limit']) {
        $offset = 1;
        while(!empty($response['services'])) {
          $request = new GetServicesRequest();
          $request->mergeQuery(['offset' => ++$offset]);
          $response = $this->client->connector->send($request)->json();
          foreach($response['services'] as $entry) {
            array_push($services, $entry);
          }
        }
      }

      return $services;
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
        'caid' => 'integer',
      ];
      $this->validate($parameters, $supported);

      $request = new GetServicesRequest();
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
      $response = $this->client->connector->send(new GetServiceRequest($id))->json();

      if($response === 'Service not found') {
        return $this->errorResponse('Service with ID ' . $id . ' not found.');
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }
}
