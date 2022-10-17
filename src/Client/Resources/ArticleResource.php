<?php

namespace Weisl\HellocashPhpSdk\Client\Resources;

use Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException;
use Weisl\HellocashPhpSdk\Interfaces\Resources\ArticleResourceInterface;
use Weisl\HellocashPhpSdk\SDK\Requests\Articles\ChangeArticleStockRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Articles\GetArticleRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Articles\GetArticlesRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Articles\GetArticleStockChangeRequest;
use Weisl\HellocashPhpSdk\SDK\Requests\Articles\CreateOrUpdateArticleRequest;

class ArticleResource extends Resource implements ArticleResourceInterface
{
  public function all(): array
  {
    try {
      $articles = [];

      $response = $this->client->connector->send(new GetArticlesRequest())->json();
      foreach($response['articles'] as $entry) {
        array_push($articles, $entry);
      }

      if($response['count'] > $response['limit']) {
        $offset = 1;
        while(!empty($response['articles'])) {
          $request = new GetArticlesRequest();
          $request->mergeQuery(['offset' => ++$offset]);
          $response = $this->client->connector->send($request)->json();
          foreach($response['articles'] as $entry) {
            array_push($articles, $entry);
          }
        }
      }

      return $articles;
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

      $request = new GetArticlesRequest();
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
      $response = $this->client->connector->send(new GetArticleRequest($id))->json();

      if($response === 'Article not found') {
        return $this->errorResponse('Article with ID ' . $id . ' not found.');
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function getStockChange(int $id): array
  {
    try {
      $response = $this->client->connector->send(new GetArticleStockChangeRequest($id))->json();

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function changeStock(int $id, array $body): array
  {
    try {
      $supported = [
        'stock_change' => 'integer|double',
        'stock_invoice_number' => 'integer|double',
        'stock_delivery_note_number' => 'integer|double',
        'stock_description' => 'string',
      ];
      $this->validate($body, $supported);

      $request = new ChangeArticleStockRequest($id);
      $request->setData($body);
      $response = $this->client->connector->send($request)->json();

      if(isset($response['error'])) {
        return $this->errorResponse('Changing stock of ' . $id . ' was not successful. Error message from API: ' . $response['error']);
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }

  public function createOrUpdate(array $body): array
  {
    try {
      $supported = [
        'article_id' => 'integer|double',
        'article_name' => 'string',
        'article_code' => 'string',
        'article_unit' => 'string',
        'article_stock' => 'integer|double',
        'article_comment' => 'string',
        'article_color' => 'string', // enum (color-1 to color-19)
        'article_supplier_id' => 'integer|double',
        'article_manufacturer_id' => 'integer|double',
        'article_foreign_company_id' => 'integer|double',
        'article_category_id' => 'integer|double',
        'article_negative_stock' => 'boolean',
        'article_stock_status' => 'integer', // enum (0-2)
        'article_quick_edit' => 'boolean',
        'article_image' => 'string',
        'article_image_text' => 'boolean',
        'article_net_purchase_price' => 'integer|double',
        'article_ean_code' => 'string',
        'article_tax_rate' => 'integer|double',
        'article_gross_selling_price' => 'string',
        'article_min_stock' => 'string',
        'article_billReference' => 'boolean',
      ];
      $this->validate($body, $supported);

      $request = new CreateOrUpdateArticleRequest();
      $request->setData($body);
      $response = $this->client->connector->send($request)->json();

      if(isset($response['error'])) {
        return $this->errorResponse('Article could not be created or updated. Error message from API: ' . $response['error']);
      }

      return $response;
    } catch(\Exception $e) {
      throw new SDKRequestFailedException($e->getMessage());
    }
  }
}
