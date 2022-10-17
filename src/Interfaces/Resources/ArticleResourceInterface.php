<?php

namespace Weisl\HellocashPhpSdk\Interfaces\Resources;

interface ArticleResourceInterface
{
  /**
   * See https://hellocash.docs.apiary.io/#reference/0/articles/get-a-list-of-articles
   *
   * Returns all article entries. This really means all. If there are more than 250,
   * the SDK will iterate over the pages and give you an array of all the documents.
   * 
   * In case there are no documents, this will return an empty array.
   *
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array of documents or empty array in case there are no documents.
   */
  public function all(): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/articles/get-a-list-of-articles
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
   * See https://hellocash.docs.apiary.io/#reference/0/articles/get-a-specific-article
   *
   * Get single article.
   *
   * @param int $id of the article
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function get(int $id): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/articles/get-article-stock-changes
   *
   * Get single article stock change.
   *
   * @param int $id of the article
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array 1:1 API response
   */
  public function getStockChange(int $id): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/articles/change-article-stock
   *
   * Change article stock.
   *
   * @param int $id of the article
   * @param array $body of the POST request
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function changeStock(int $id, array $body): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/articles/create/update-article
   *
   * Create or update existing article.
   * Array passed will be transformed into json body.
   *
   * @param array $body of the POST request
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function createOrUpdate(array $body): array;
}