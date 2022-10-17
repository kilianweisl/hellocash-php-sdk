<?php

namespace Weisl\HellocashPhpSdk\Interfaces\Resources;

interface InvoiceResourceInterface
{
  /**
   * See https://hellocash.docs.apiary.io/#reference/0/invoices/get-a-list-of-invoices
   *
   * Returns all invoices. This really means all. If there are more than 1000,
   * the SDK will iterate over the pages and give you an array of all the documents.
   * 
   * In case there are no documents, this will return an empty array.
   *
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array of documents or empty array in case there are no documents.
   */
  public function all(): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/invoices/get-a-list-of-invoices
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
   * See https://hellocash.docs.apiary.io/#reference/0/invoices/get-a-specific-invoice
   *
   * Get single invoice.
   *
   * @param int $id of the invoice
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function get(int $id): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/invoices/create-a-new-invoice
   *
   * Create new invoice. Minimum body: cashier_id and 1 item with item_name.
   * Array passed will be transformed into json body.
   *
   * @param array $body of the POST request
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function create(array $body): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/invoices/get-a-specific-invoice-as-pdf
   *
   * Get invoice as PDF.
   *
   * @param int $id of the invoice
   * @param array $parameters
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function pdf(int $id, array $parameters = []): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/invoices/cancel-an-invoice
   *
   * Cancel invoice.
   *
   * @param int $id of the invoice
   * @param array $body of the POST request
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array in case of failure error-response (see Readme.md) otherwise 1:1 API response
   */
  public function cancel(int $id, array $body = []): array;
}