<?php

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

/**
 * Represents the Files endpoint for managing files and their interactions with the OpenAI API.
 *
 * @link     https://platform.openai.com/docs/api-reference/files
 * @link     https://platform.openai.com/docs/api-reference/files/object
 *
 * @internal This class is not meant to be used by library users.
 */
final class Files extends Endpoint
{
    /**
     * Returns a list of files that belong to the user's organization.
     *
     * @return array<string, mixed> An array containing the list of files and other information.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/files/list
     * @link https://platform.openai.com/docs/api-reference/files/object
     */
    public function list(): array
    {
        return $this->handler->execute(new Request('get', 'files'));
    }

    /**
     * Upload a file that contains document(s) to be used across various endpoints/features. Currently, the size of all
     * the files uploaded by one organization can be up to 1 GB. Please contact us if you need to increase the storage
     * limit.
     *
     * @param array<string, mixed> $options Options for configuring the file upload.
     *
     * @return array<string, mixed> An array containing the uploaded file information and other details.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/files/create
     */
    public function upload(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'files', $options)
        );
    }

    /**
     * Delete a file.
     *
     * @param array<string, mixed> $options Options for configuring the file deletion.
     *
     * @return array<string, mixed> An array containing information about the deleted file and other details.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/files/delete
     */
    public function delete(array $options = []): array
    {
        return $this->handler->execute(
            new Request('delete', 'files', $options)
        );
    }

    /**
     * Returns information about a specific file.
     *
     * @param string $fileId The ID of the file to retrieve information for.
     *
     * @return array<string, mixed> An array containing information about the requested file and other details.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/files/retrieve
     */
    public function retrieve(string $fileId): array
    {
        return $this->handler->execute(new Request('get', "files/{$fileId}"));
    }

    /**
     * Returns the contents of the specified file.
     *
     * @param string $fileId The ID of the file to retrieve content for.
     *
     * @return array<string, mixed> An array containing the content of the requested file and other details.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/files/retrieve-contents
     */
    public function content(string $fileId): array
    {
        return $this->handler->execute(new Request('get', "files/{$fileId}/content"));
    }
}
