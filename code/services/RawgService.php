<?php

class RawgService
{
    private string $apiKey;
    private string $baseUrl = "https://api.rawg.io/api";
    private int $timeout = 5;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/api.php';
        $this->apiKey = $config['rawg_key'];
    }

    /**
     * Search games by name.
     * Returns an array of results, or throws a RuntimeException on failure.
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

