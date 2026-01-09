<?php

declare(strict_types=1);

namespace SharpAPI\ContentKeywords;

use GuzzleHttp\Exception\GuzzleException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * Generate keywords and tags from content using AI
 *
 * @package SharpAPI\ContentKeywords
 * @api
 */
class KeywordsTagsClient extends SharpApiClient
{
    public function __construct(
        string $apiKey,
        ?string $apiBaseUrl = 'https://sharpapi.com/api/v1',
        ?string $userAgent = 'SharpAPIPHPContentKeywords/1.0.0'
    ) {
        parent::__construct($apiKey, $apiBaseUrl, $userAgent);
    }

    /**
     * Generate keywords and tags from content using AI
     *
     * @param string $content The text content to process
     * @param string $language Output language (default: English)
     * @param string|null $voiceTone Optional tone of voice
     * @param int|null $maxQuantity Optional maximum quantity
     * @param string|null $context Optional additional context
     * @return string Status URL for polling the job result
     * @throws GuzzleException
     * @api
     */
    public function generateKeywords(
        string $content,
        string $language = 'English',
        ?string $voiceTone = null,
        ?int $maxQuantity = null,
        ?string $context = null
    ): string {
        $response = $this->makeRequest('POST', '/content/keywords', array_filter([
            'content' => $content,
            'language' => $language,
            'voice_tone' => $voiceTone,
            'max_quantity' => $maxQuantity,
            'context' => $context
        ], fn($v) => $v !== null));

        return $this->parseStatusUrl($response);
    }
}
