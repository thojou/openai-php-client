<?php

declare(strict_types=1);

/*
 * This file is part of OpenAi PHP Client.
 *
 * (c) Thomas Joußen <tjoussen91@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Thojou\OpenAi\Endpoint;

use Thojou\OpenAi\Exception\OpenAiException;
use Thojou\OpenAi\Request;

/**
 * Represents the Fine-Tuning endpoint for managing fine-tuning jobs to tailor a model to your specific training data
 * and their interactions with the OpenAI API.
 *
 * @link     https://platform.openai.com/docs/api-reference/fine-tuning
 * @link     https://platform.openai.com/docs/api-reference/fine-tuning/object
 *
 * @internal This class is not meant to be used by library users.
 */
class FineTuning extends Endpoint
{
    /**
     * Creates a job that fine-tunes a specified model from a given dataset.
     *
     * @param array<string, mixed> $options Options for configuring the creation of the fine-tuning model.
     *
     * @return array<string, mixed> An array containing information about the created fine-tuning job object
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/create
     */
    public function create(array $options = []): array
    {
        return $this->handler->execute(
            new Request('post', 'fine_tuning/jobs', $options)
        );
    }

    /**
     * Get info about a fine-tuning job.
     *
     * @param string $fineTuningJobId The ID of the fine-tuning job to retrieve information for.
     *
     * @return array<string, mixed> An array containing information about the requested fine-uning job.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/retrieve
     */
    public function retrieve(string $fineTuningJobId): array
    {
        return $this->handler->execute(new Request('get', "fine_tuning/jobs/{$fineTuningJobId}"));
    }

    /**
     * Immediately cancel a fine-tune job.
     *
     * @param string $fineTuningJobId The ID of the fine-tuning job to cancel.
     *
     * @return array<string, mixed> An array containing information about the canceled fine-tuning object.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/cancel
     */
    public function cancel(string $fineTuningJobId): array
    {
        return $this->handler->execute(new Request('post', "fine_tuning/jobs/{$fineTuningJobId}/cancel"));
    }

    /**
     * Get status updates for a fine-tuning job.
     *
     * @param string $fineTuningJobId The ID of the fine-tuning job to retrieve events for.
     *
     * @return array<string, mixed> An array containing events related to the specified fine-tuning job.
     *
     * @throws OpenAiException If there's an issue with the API request or response.
     *
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/list-events
     */
    public function events(string $fineTuningJobId): array
    {
        return $this->handler->execute(new Request('get', "fine_tuning/jobs/{$fineTuningJobId}/events"));
    }
}
