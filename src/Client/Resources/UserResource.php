<?php

namespace Weisl\HellocashPhpSdk\Client\Resources;

use Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException;
use Weisl\HellocashPhpSdk\Interfaces\Resources\UserResourceInterface;
use Weisl\HellocashPhpSdk\SDK\Requests\Users\GetUsersRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Users\CreateUserRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Users\UpdateUserRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Users\GetUserRequest;

class UserResource extends Resource implements UserResourceInterface
{
  public function all(): array
  {
    try {
      $users = [];

      $response = $this->client->connector->send(new GetUsersRequest())->json();
      foreach($response['users'] as $entry) {
        array_push($users, $entry);
      }

      if($response['count'] > $response['limit']) {
        $offset = 1;
        while(!empty($response['users'])) {
          $request = new GetUsersRequest();
          $request->mergeQuery(['offset' => ++$offset]);
          $response = $this->client->connector->send($request)->json();
          foreach($response['users'] as $entry) {
            array_push($users, $entry);
          }
        }
      }

      return $users;
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
      ];
      $this->validate($parameters, $supported);

      $request = new GetUsersRequest();
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
      $response = $this->client->connector->send(new GetUserRequest($id))->json();

      if($response === 'User not found') {
        return $this->errorResponse('User with ID ' . $id . ' not found.');
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function create(array $body): array
  {
    try {
      $supported = [
        'user_salutation' => 'string',
        'user_firstname' => 'string',
        'user_surname' => 'string',
        'user_company' => 'string',
        'user_email' => 'string',
        'user_phoneNumber' => 'string',
        'user_postalCode' => 'string',
        'user_city' => 'string',
        'user_street' => 'string',
        'user_houseNumber' => 'string',
        'user_birthday' => 'string',
        'user_uidNumber' => 'string',
        'user_notes' => 'string',
        'user_country_code' => 'string',
      ];
      $this->validate($body, $supported);

      $request = new CreateUserRequest();
      $request->setData($body);
      $response = $this->client->connector->send($request)->json();

      if(isset($response['error'])) {
        return $this->errorResponse('User could not be created. Error message from API: ' . $response['error']);
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function update(int $id, array $body): array
  {
    try {
      $supported = [
        'user_salutation' => 'string',
        'user_firstname' => 'string',
        'user_surname' => 'string',
        'user_company' => 'string',
        'user_email' => 'string',
        'user_phoneNumber' => 'string',
        'user_postalCode' => 'string',
        'user_city' => 'string',
        'user_street' => 'string',
        'user_houseNumber' => 'string',
        'user_birthday' => 'string',
        'user_uidNumber' => 'string',
        'user_notes' => 'string',
        'user_country_code' => 'string',
      ];
      $this->validate($body, $supported);

      $request = new UpdateUserRequest($id);
      $request->setData($body);
      $response = $this->client->connector->send($request)->json();

      if(isset($response['error'])) {
        return $this->errorResponse('User could not be updated. Error message from API: ' . $response['error']);
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }
}
