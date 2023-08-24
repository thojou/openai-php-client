# OpenAi PHP Client

![Static Badge](https://img.shields.io/badge/PHP_Version-%3E%3D8.1-blue)
[![CI](https://github.com/thojou/openai-php-client/actions/workflows/ci.yml/badge.svg)](https://github.com/thojou/openai-php-client/actions/workflows/ci.yml)
![Coverage](https://img.shields.io/badge/coverage-100%25-green)
[![License](https://img.shields.io/github/license/thojou/openai-php-client)](./LICENSE)


The **OpenAi PHP Client** is a user-friendly PHP library designed to facilitate interactions with the OpenAI Rest API.

## Requirements
* PHP version >= 8.1

## Installation

You can effortlessly install the **OpenAi PHP Client** using the popular package manager [composer](https://getcomposer.org/) to install OpenAi PHP Client.

```bash
composer require thojou/openai-php-client
```

## Usage

To begin utilizing the capabilities of the **OpenAi PHP Client**, you'll need an active OpenAI API key. If you don't have one yet, you can obtain it [here](https://platform.openai.com/account/api-keys).

```php
<?php

use Thojou\OpenAi\OpenAi;

require_once __DIR__ . '/vendor/autoload.php';

$apiKey = "<YOUR API KEY>";

$openAi = new OpenAi($apiKey);
$result = $openAI->chat()->completion([
    'model' => 'gpt-3.5-turbo',
    'prompt' => 'This is a test',
]);

echo $result['choices'][0]['message']['content']; // Prints the openai chat answer
```

For more practical examples, please refer to the [examples](./examples) folder.

## Limitations

Certain endpoints, namely [Edits](https://platform.openai.com/docs/api-reference/edits), [Fine-Tunes](https://platform.openai.com/docs/api-reference/fine-tunes) and [Completions](https://platform.openai.com/docs/api-reference/completions), are not integrated due to their deprecated status within the OpenAI API.

## Documentation

The **OpenAi PHP Client** is designed to seamlessly align with the request and response formats meticulously outlined in the [OpenAI API documentation](https://platform.openai.com/docs/api-reference). This comprehensive resource offers all the essential information about request structures and expected responses.

### OpenAi Class

The `OpenAi` class is a central component of the OpenAI API interaction library. It provides methods for accessing different API endpoints such as Models, Chat, Images, Embeddings, Audio, Files, Fine-Tuning, and Moderations.

#### Constructor

```php
public function __construct(
    string $apiKey,
    string $baseUri = 'https://api.openai.com/v1/'
)
```

Creates an instance of the `OpenAi` class.

- Parameters:
    - `$apiKey` (string): The API key to authenticate with the OpenAI API.
    - `$baseUri` (string, optional): The base URI for API requests. Defaults to `'https://api.openai.com/v1/'`.

#### Methods

##### `models()`

```php
public function models(): Models
```

Returns an instance of the Models endpoint.

- Returns:
    - `Models`: An instance of the Models endpoint.

##### `chat()`

```php
public function chat(): Chat
```

Returns an instance of the Chat endpoint.

- Returns:
    - `Chat`: An instance of the Chat endpoint.

##### `images()`

```php
public function images(): Images
```

Returns an instance of the Images endpoint.

- Returns:
    - `Images`: An instance of the Images endpoint.

##### `embeddings()`

```php
public function embeddings(): Embeddings
```

Returns an instance of the Embeddings endpoint.

- Returns:
    - `Embeddings`: An instance of the Embeddings endpoint.

##### `audio()`

```php
public function audio(): Audio
```

Returns an instance of the Audio endpoint.

- Returns:
    - `Audio`: An instance of the Audio endpoint.

##### `files()`

```php
public function files(): Files
```

Returns an instance of the Files endpoint.

- Returns:
    - `Files`: An instance of the Files endpoint.

##### `fineTuning()`

```php
public function fineTuning(): FineTuning
```

Returns an instance of the FineTuning endpoint.

- Returns:
    - `FineTuning`: An instance of the FineTuning endpoint.

##### `moderation()`

```php
public function moderation(): Moderations
```

Returns an instance of the Moderations endpoint.

- Returns:
    - `Moderations`: An instance of the Moderations endpoint.


This class provides a structured way to interact with various endpoints of the OpenAI API. Each method returns an instance of the corresponding endpoint class, allowing you to perform API operations more efficiently.

## License

This project is licensed under the generous and permissive [MIT license](./LICENSE).