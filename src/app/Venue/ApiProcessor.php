<?php

namespace App\Venue;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\InvalidApiResponseException;

/**
 * @author Ino Monares <ino.monares@gmail.com>
 *
 * Wrapper for all API fetching actions
 */
class ApiProcessor
{
    /**
     * @var $client Client
     */
    private $client;

    /**
     * @var $baseUri string
     */
    protected $baseUri = '';

    /**
     * @var $cacheScope string
     */
    protected $cacheScope = '';

    /**
     * This initializes the CI instane for the API and the drives needed for CACHING data
     * We will need to cache data, since we want to preserve data that we have previously fetch and to not overload our usage (currently using free tier)
     * This is where the GuzzleHttp client is also initialized
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Set cache data based on URI pinged by the API
     * This is so we have cached data and wont need to overload our API usage
     *
     * @param string $uri
     * @param GuzzleHttp\Stream $data
     *
     * @return void
     */
    public function setUriCache($uri, $data)
    {
        // transform an GuzzleHttp object into a JSON string
        $data = json_encode(json_decode($data, true));
        $cacheKey = $this->getCacheKey($uri);
        Log::info(self::class.': setUriCache: '.$cacheKey);
        // Cache::store('redis')->add($cacheKey, $data, 7200); // 2 hours
        Cache::add($cacheKey, $data, 7200); // 2 hours
    }

    /**
     * Return our previously cached data based on the API being fetched and the `uri` that was pinged
     *
     * @param string $uri
     *
     * @return string
     */
    public function getUriCache($uri)
    {
        $cacheKey = $this->getCacheKey($uri);
        Log::info(self::class.': getUriCache: '.$cacheKey);
        // if ($cache = Cache::store('redis')->get($cacheKey)) {
        if ($cache = Cache::get($cacheKey)) {
            return $cache;
        }

        return false;
    }

    /**
     * Get API response via our GuzzleHttp client
     * We also fallback to cached data, if possible
     * Then for every successfull ping, we store the data for CACHING (TTL=120 seconds)
     *
     * @param string $uri
     *
     * @return GuzzleHttp\Stream
     */
    public function getApi($uri)
    {
        Log::info(self::class.': getUriCache: '.$this->getCacheKey($uri));

        if ($cache = $this->getUriCache($uri)) {
            Log::info(self::class.': get cache: '.$this->getCacheKey($uri));
            return $cache;
        }

        try {
            $response = $this->client->get($this->baseUri . $uri);
            if ($response->getStatusCode() !== 200) {
                throw new InvalidApiResponseException();
            }
        } catch (\Exception $e) {
            // what to do??
            die($e->getMessage());
        } catch (InvalidApiResponseException $e) {
            // what to do??
        }

        $this->setUriCache($uri, $response->getBody());

        return $response->getBody();
    }

    /**
     * Generate a CACHE key used for storage and retrieval
     *
     * @param string $cacheReference
     *
     * @return string
     */
    private function getCacheKey($cacheReference)
    {
        return $this->cacheScope . md5($cacheReference);
    }
}
