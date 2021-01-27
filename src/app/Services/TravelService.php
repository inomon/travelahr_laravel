<?php

namespace App\Services;

use App\Venue\Search as VenueSearch;
use App\Venue\Weather as VenueWeather;

class TravelService extends BaseService
{
    /**
     * @var VenueSearch
     */
    protected $venueSearch;

    /**
     * @var VenueWeather
     */
    protected $venueWeather;

    /**
     * TravelService constructor
     *
     * @param VenueSearch $venueSearch
     * @param VenueWeather $venueWeather
     */
    public function __construct(
        VenueSearch $venueSearch,
        VenueWeather $venueWeather
    ) {
        $this->venueSearch = $venueSearch;
        $this->venueWeather = $venueWeather;
    }

    /**
     * Search for venues based on the input submitted on the location form
     *
     * @param integer $limit
     * @param boolean $includeWeather
     *
     * @return array
     */
    public function searchVenues($getSearch = false, $limit = 10, $includeWeather = true, $showFooterForm = true, $pageName = null)
    {
        $cityName = $getSearch ? $this->input('city') : 'Tokyo';
        $countryCode = $getSearch ? $this->input('country') : 'JP';
        $pageName = ($pageName ? $pageName : sprintf('%s, %s', $cityName, $countryCode));
        $weather = [];

        $venues = $this->venueSearch->getVenues($cityName, $countryCode, env('FOURSQUARE_CATEGORIES'), $limit);
        $mastheadImageLink = ($venues) ? $venues['masthead_image_link'] : '';

        if ($includeWeather) {
            $weather = $this->venueWeather->getWeather($cityName, $countryCode);
        }

        return [
            'weather'           => $weather,
            'venues'            => $venues,
            'selectedCity'      => $cityName,
            'selectedCountry'   => $countryCode,
            'showFooterForm'    => $showFooterForm,
            'pageName'          => $pageName,
            'mastheadImageLink' => $mastheadImageLink,
        ];
    }


}
