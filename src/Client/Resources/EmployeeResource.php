<?php

namespace Weisl\HellocashPhpSdk\Client\Resources;

use Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException;
use Weisl\HellocashPhpSdk\Interfaces\Resources\EmployeeResourceInterface;
use Weisl\HellocashPhpSdk\SDK\Requests\Employees\GetEmployeeRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Employees\GetEmployeesRequest;

class EmployeeResource extends Resource implements EmployeeResourceInterface
{
  public function all(): array
  {
    try {
      $response = $this->client->connector->send(new GetEmployeesRequest())->json();

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function get(int $id): array
  {
    try {
      $response = $this->client->connector->send(new GetEmployeeRequest($id))->json();

      if($response === 'Employee not found') {
        return $this->errorResponse('Employee with ID ' . $id . ' not found.');
      }
      
      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }
}
