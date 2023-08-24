# OpenAi PHP Client

[![CI](https://github.com/thojou/openai-php-client/actions/workflows/ci.yml/badge.svg)](https://github.com/thojou/openai-php-client/actions/workflows/ci.yml)

The **OpenAi PHP Client** is a user-friendly PHP library designed to facilitate interactions with the OpenAI Rest API.

## Requirements
* PHP version >= **8.1**

## Installation

You can effortlessly install the **OpenAi PHP Client** using the popular package manager [composer](https://getcomposer.org/) to install OpenAi PHP Client.

```bash
composer require thojou/openai-php-client
```

## Usage

To begin utilizing the capabilities of the **OpenAi PHP Client**, you'll need an active OpenAI API key. If you don't have one yet, you can obtain it [here](https://platform.openai.com/account/api-keys).

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Thojou\OpenAi\OpenAi;

$apiKey = "<YOUR API KEY>";

$openAi = new OpenAi($apiKey);
$result = $openAI->chat()->completion([
    'model' => 'gpt-3.5-turbo',
    'prompt' => 'This is a test',
]);

echo $result['choices'][0]['message']['content']; // Prints the openai chat answer
```

For more practical examples, please refer to the examples folder.

## Documentation

The **OpenAi PHP Client** is designed to seamlessly align with the request and response formats meticulously outlined in the [OpenAI API documentation](https://platform.openai.com/docs/api-reference). This comprehensive resource offers all the essential information about request structures and expected responses.

## Limitations

Certain endpoints, namely [Edits](https://platform.openai.com/docs/api-reference/edits) and [Completions](https://platform.openai.com/docs/api-reference/completions), are not integrated due to their deprecated status within the OpenAI API.

## License

This project is licensed under the generous and permissive [MIT license](./LICENSE).