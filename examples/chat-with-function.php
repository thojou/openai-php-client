<?php

use Thojou\OpenAi\OpenAi;

$API_KEY = $argv[1];

require_once __DIR__ . '/../vendor/autoload.php';

function hasEmployeeBirthday(string $employee): bool
{
    return in_array($employee, ["Alice", "Bob", "Marry"]);
}

// Describe available functions
$functions = [
    [
        'name' => 'hasEmployeeBirthday',
        'description' => 'Check if employee has birthday today',
        'parameters' => [
            'type' => 'object',
            'properties' => [
                'employee' => ['type' => 'string']
            ],
            'required' => [
                'employee'
            ]
        ]
    ]
];

$messages = [
    ['role' => 'user', 'content' => 'Hello, is today Alice\'s birthday?']
];

// Pass the available functions into the chat completion
$openAi = new OpenAi($API_KEY);
$result = $openAi->chat()->completion([
    'model' => 'gpt-3.5-turbo',
    'messages' => $messages,
    'functions' => $functions
]);

echo json_encode($result, JSON_PRETTY_PRINT) . "\n";

if(!is_array($result['choices'])) {
    return;
}

// if finish_reason is function_call, openai asked for a function call
if ($result['choices'][0]['finish_reason'] !== 'function_call') {
    echo "No function call found\n";
    return;
}

// Evaluate the function call
$functionCall = $result['choices'][0]['message']['function_call'];
$functionName = $functionCall['name'];
$functionArgs = (array)json_decode($functionCall['arguments'], true);

if (!function_exists($functionName)) {
    echo "Function $functionName not found\n";
    return;
}

// Call the function
$functionResult = call_user_func_array($functionName, $functionArgs);

// Insert the function result into the messages array. You don't have to add the function call answer from the assistant
$messages[] = [
    'role' => 'function',
    'content' => $functionResult ? 'Yes' : 'No',
    'name' => $functionName,
];

$result = $openAi->chat()->completion([
    'model' => 'gpt-3.5-turbo',
    'messages' => $messages,
    'functions' => $functions
]);

echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
