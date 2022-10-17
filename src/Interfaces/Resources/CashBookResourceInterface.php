<?php

namespace Weisl\HellocashPhpSdk\Interfaces\Resources;

interface CashBookResourceInterface
{
  /**
   * See https://hellocash.docs.apiary.io/#reference/0/cashbook/get-a-list-of-cashbook-entries
   *
   * Returns all cash book entries. This really means all. If there are more than 1000,
   * the SDK will iterate over the pages and give you an array of all the documents.
   * 
   * In case there are no documents, this will return an empty array.
   *
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array of documents or empty array in case there are no documents.
   */
  public function all(): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/cashbook/get-a-list-of-cashbook-entries
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
   * See https://hellocash.docs.apiary.io/#reference/0/cashbook/get-the-cashbook-saldo
   *
   * Get cache book saldo.
   *
   * @param array $parameters
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array 1:1 API response
   */
  public function saldo(array $parameters): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/cashbook/create-a-new-cashbook-entry
   *
   * Create new cash book entry.
   * Array passed will be transformed into json body.
   *
   * @param array $body of the POST request
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function create(array $body): array;
}