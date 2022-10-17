<?php

namespace Weisl\HellocashPhpSdk\Interfaces\Resources;

interface UserResourceInterface
{
  /**
   * See https://hellocash.docs.apiary.io/#reference/0/users/get-a-list-of-users
   *
   * Returns all users. This really means all. If there are more than 250,
   * the SDK will iterate over the pages and give you an array of all the documents.
   * 
   * In case there are no documents, this will return an empty array.
   *
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array of documents or empty array in case there are no documents.
   */
  public function all(): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/users/get-a-list-of-users
   *
   * You can pass all supported parameters to this method. Please refer to the link above.
   * This will validate and type check the passed values.
   * Returns a 1:1 response from the API.
   *
   * @param array $parameters
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array 1:1 API response
   */
  public function query(array $parameters): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/users/get-a-specific-user
   *
   * Get single user.
   *
   * @param int $id of the user
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function get(int $id): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/users/create-a-new-user
   *
   * Create new user.
   * Array passed will be transformed into json body.
   *
   * @param array $body of the POST request
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function create(array $body): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/users/update-a-existing-user
   *
   * Update a user.
   * Array passed will be transformed into json body.
   *
   * @param int $id of the user
   * @param array $body of the POST request
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function update(int $id, array $body): array;
}