<?php

namespace Weisl\HellocashPhpSdk\Interfaces;

use Weisl\HellocashPhpSdk\Interfaces\Resources\ArticleResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\CashBookResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\EmployeeResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\InvoiceResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\PaymentMethodResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\ServiceResourceInterface;
use Weisl\HellocashPhpSdk\Interfaces\Resources\UserResourceInterface;

interface HellocashClientInterface
{
  /**
   * See https://hellocash.docs.apiary.io/#reference/0/invoices
   *
   * @return InvoiceResourceInterface
   */
  public function invoices(): InvoiceResourceInterface;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/employees
   *
   * @return EmployeeResourceInterface
   */
  public function employees(): EmployeeResourceInterface;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/payment-methods
   *
   * @return PaymentMethodResourceInterface
   */
  public function paymentMethods(): PaymentMethodResourceInterface;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/cashbook
   *
   * @return CashBookResourceInterface
   */
  public function cashBook(): CashBookResourceInterface;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/articles
   *
   * @return ArticleResourceInterface
   */
  public function articles(): ArticleResourceInterface;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/services
   *
   * @return ServiceResourceInterface
   */
  public function services(): ServiceResourceInterface;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/users
   *
   * @return UserResourceInterface
   */
  public function users(): UserResourceInterface;
}
