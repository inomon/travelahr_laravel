<?php

namespace App\Venue;

use App\Venue\ApiProcessor;

/**
 * @author Ino Monares <ino.monares@gmail.com>
 *
 * Venue API endpoint builder, via the 4sqr platform
 */
class Search extends ApiProcessor
{
    /**
     * We initialize the `ApiProcessor` here for use in our API calls
     */
    public function __construct()
    {
        parent::__construct();
        $this->cacheScope = self::class;
        $this->baseUri = 'https://api.foursquare.com';
    }

    /**
     * Call on the 4sqr places API, to fetch a list of venues/places based on a CITY & COUNTRY query
     * I've added an additional `categoryId` to the endpoint query to increase the possible list of suggested places
     *
     * @param string  $cityName
     * @param string  $countryCode
     * @param string  $categoryId CSV format for category IDs from 4sqr API - see `.env.example` file for further details
     * @param integer $limit
     *
     * @return array
     */
    public function getVenues($cityName, $countryCode, $categoryId, $limit = 5)
    {
        // fetch the suggested places based on our query parameters
        // here, we have also specified the FOURSQUARE CLIENT parameters - generated from the 4sqr DEVELOPER portal
        $response = $this->getApi(
            sprintf(
                '/v2/venues/search?near=%s,%s&limit=%s&categoryId=%s&client_id=%s&client_secret=%s&v=%s',
                $cityName,
                $countryCode,
                $limit,
                $categoryId,
                env('FOURSQUARE_CLIENT_ID'),
                env('FOURSQUARE_CLIENT_SECRET'),
                date('Ymd')
            )
        );

        // our response, either from CACHED data or from LIVE ENDPOINT, is already the body of the response
        // we can then decode it via JSON format
        $venues = json_decode($response, true);

        if (!isset($venues['response']) || count($venues['response']['venues']) === 0) {
            // if we dont have anything, lets return immediately
            return null;
        }

        $venues = $venues['response']['venues'];

        // when we have the list of venues, we can pull each of there representative photos that we can use for display
        // as well as generate a link for their category icons that we will display on the list
        foreach ($venues as $index => $venue) {
            $photo = $this->getVenuePhoto($venue['id']);
            $photo['photo_link'] = $photo['prefix'] . $photo['width'] . 'x' . $photo['height'] . $photo['suffix'];
            $venues[$index]['photo'] = $photo;
            $venues[$index]['category_icon_link'] = sprintf('%s64%s', $venue['categories'][0]['icon']['prefix'], $venue['categories'][0]['icon']['suffix']);
            $venues[$index]['map_query'] = urlencode(sprintf('%s, %s "%s,%s"', $venue['name'], ($venue['location']['address']??''), $venue['location']['lat'], $venue['location']['lng']));
        }

        // the masthead image is the representative image for the list of venues that weve retrieved
        // usually, we use the first venue data, then we display it at the top of the pages cover head
        if (count($venues) > 0) {
            $venues['masthead_image_link'] = $venues[0]['photo']['photo_link'];
        }

        return $venues;
    }

    /**
     * We pull venue photos via the `$venueId`
     * These are used to give an image representation for each venue that was fetched
     *
     * @param string $venueId
     *
     * @return array
     */
    public function getVenuePhoto($venueId)
    {
        // fetch the photo(s) data for the specific venue
        $response = $this->getApi(
            sprintf(
                '/v2/venues/%s/photos?client_id=%s&client_secret=%s&v=%s',
                $venueId,
                env('FOURSQUARE_CLIENT_ID'),
                env('FOURSQUARE_CLIENT_SECRET'),
                date('Ymd')
            )
        );

        $venuePhoto = json_decode($response, true);

        if (!isset($venuePhoto['response']) || $venuePhoto['response']['photos']['count'] === 0) {
            return null;
        }

        // we only need the first one, so lets just only return it
        return $venuePhoto['response']['photos']['items'][0];
    }
}
