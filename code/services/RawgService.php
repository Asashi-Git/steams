<?php

class RawgService
{
    private string $apiKey;
    private string $baseUrl = "https://api.rawg.io/api";
    private int    $timeout = 5;

    public function __construct()
    {
        $config       = require __DIR__ . '/../config/api.php';
        $this->apiKey = $config['rawg_key'];
    }

    /**
     * Search games by name.
     */
    public function searchGames(string $query, int $pageSize = 10): array
    {
        if (empty(trim($query))) {
            throw new InvalidArgumentException("Search query cannot be empty.");
        }

        $url = $this->baseUrl . "/games?" . http_build_query([
            'key'       => $this->apiKey,
            'search'    => $query,
            'page_size' => $pageSize
        ]);

        $response = $this->fetch($url);

        return $response['results'] ?? [];
    }

    /**
     * Fetch a single game's full details by its RAWG id.
     */
    public function getGameById(int $rawgId): ?array
    {
        $url = $this->baseUrl . "/games/" . $rawgId . "?key=" . $this->apiKey;

        try {
            $data = $this->fetch($url);
        } catch (RuntimeException $e) {
            return null;
        }

        return $this->formatGame($data);
    }

    /**
     * Normalize a raw RAWG payload into your DB structure.
     */
    public function formatGame(array $raw): array
    {
        return [
            'rawg_id'      => $raw['id']                      ?? null,
            'title'        => $raw['name']                    ?? 'Unknown',
            'description'  => strip_tags($raw['description_raw'] ?? ''),
            'release_date' => $raw['released']                ?? null,
            'cover_image'  => $raw['background_image']        ?? null,
        ];
    }

    /**
     * Core cURL wrapper — all HTTP calls go through here.
     */
    private function fetch(string $url): array
    {
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => $this->timeout,
            CURLOPT_FAILONERROR    => true,
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new RuntimeException("cURL error: " . $error);
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException("Invalid JSON received from API.");
        }

        return $data;
    }
}

