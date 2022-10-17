# Hellocash PHP SDK
This is an unofficial PHP SDK implementation for the [Hellocash API](https://hellocash.docs.apiary.io/#). It helps accessing the API in an object oriented way and uses [Saloon](https://github.com/Sammyjo20/Saloon) as a wrapper for the API.

## Requirements
* PHP >= 8.1

## Installation
```composer require weisl/hellocash-php-sdk```

## Usage
Start making requests by creating a ```HellocashClient``` object:
```php
$client = new HellocashClient('email@example.com', 'secret-password');
$response = $client->invoices()->all();
```

Please have a look at ```src/Interfaces/HellocashClientInterface``` to see how the API resources are accessible.
Each Resource has an own Interface, e.g. ```src/Interfaces/Resources/InvoiceResourceInterface``` with more detailed information about the methods and the response types.

### Error Handling
Basically, the SDK differs between 2 errors:
* Wrong usage of the SDK
* Wrong usage of the API

You can see the difference in the examples below. Just note that e.g. if you pass a wrong type as parameter to the SDK, it will throw an Exception. More specifically, the SDK throws one exception named ```SDKRequestFailedException```. If you can get through and make an actual request to the API, which fails because there is e.g. no invoice with the ID you passed, you will always get a response in the format of:
```php
[
  'error' => 'Invoice with ID 123 not found'
]
```

### Example: Invoices
This example will guide you through the usage of the SDK.

#### all()
Every resource in the SDK provides an ```all()``` method, which does what you may expect: It gets *all* documents from the resource. This also handles pagination for you (so you don't need to handle the limit, offset, etc.).
```php
$client->invoices()->all(); // gets all resources, no matter how many
```
This returns the documents directly as array, or an empty array, if there are no documents.

#### query()
Say you want to search for specific invoices. Some resources support parameters, e.g. ```limit, offset, search, ...```. A full API request could look something like this: ```https://api.hellocash.business/api/v1/invoices?limit=1000&offset=1&search=test&showDetails=true```.
Since ```all()``` might take a long time to fetch and is also unusable in case there are many, many documents, you can take full advantage of all the query parameters with the ```query()``` method.
```php
$client->invoices()->query([ // query all invoices with supported parameters
  'limit' => 50,
  'offset' => 2,
  ...
]);
```
This returns 1:1 the response from the API, so you can define the logic on your own.
The SDK does some additional things for you: Validating the attributes you pass into the query function. If you pass a parameter, which is not supported by the API, the SDK will throw an ```SDKRequestFailedException``` with information what parameter is not valid. It also type-checks the value. When the API refers to the type *number*, it can either be an integer, a float or a double. The other types should be straight forward.

#### get()
Get one specific invoice with the ```get(int $id)``` method.
```php
$client->invoices()->get($id); // get specific invoice by id
```
Since the API is not quite consistent with their error messages, the SDK does that for you. If no invoice is found with the ID you entered, the SDK provides a uniform error message, which looks like:
```php
[
  'error' => 'Invoice with ID 123 not found',
]
```

#### cancel()
Cancel takes the ID of the invoice as parameter. You can also specify the cashier in the request body. In the SDK, you simply pass an array to the cancel method:
```php
$client->invoices()->cancel($id, [
  'cancellation_cashier_id' => 123,
]);
```
Again, the SDK checks the parameters passed and handles type-checks for you.
Interestingly, the API is not consistent with error messages (and also does not provide much information about the error). The SDK gives you the same format as with all errors:
```php
[
  'error' => 'Cancellation of Invoice with 123 was not successful. API error message: An Error occurred',
]
```

#### create()
Creates an invoice.
```php
$client->invoices()->create([
  'cashier_id' => 123,
  'items' => [
    'item_name' => 'test',
  ],
]);
```
Again, the body will be validated and type-checked (first array hierarchy only).

#### pdf()
Get a pdf invoice.
```php
$client->invoices()->pdf(123);
```

## Contributing
If you would like to improve something, or if there are any bugs, feel free to contact me via email or create an issue.

## Testing
```vendor/bin/phpunit```

## Documentation
See the [Hellocash API documentation](https://hellocash.docs.apiary.io/#) or the Interfaces inside the ```src/Interfaces``` directory of this package.

## License
This package is licensed under [MIT](https://en.wikipedia.org/wiki/MIT_License) License.

Please note that I am not affiliated with Hellocash in any kind. All copyrights to this name, brand, etc. belong to the respective owner(s) and not me.
