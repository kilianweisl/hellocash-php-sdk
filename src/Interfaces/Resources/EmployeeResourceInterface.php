<?php

namespace Weisl\HellocashPhpSdk\Interfaces\Resources;

interface EmployeeResourceInterface
{
  /**
   * See https://hellocash.docs.apiary.io/#reference/0/employees/get-a-list-of-employees
   *
   * Returns all employees. Since no parameters are supported, this does not paginate through results.
   * There must be at least one employee.
   *
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array of documents
   */
  public function all(): array;

  /**
   * See https://hellocash.docs.apiary.io/#reference/0/employees/get-a-specific-employee
   *
   * Returns specific employee by ID.
   *
   * @param int $id of employee
   * @throws Weisl\HellocashPhpSdk\Client\Exceptions\SDKRequestFailedException
   * @return array of attributes
   */
  public function get(int $id): array;
}