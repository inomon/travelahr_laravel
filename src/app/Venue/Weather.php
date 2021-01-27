<?php

namespace App\Venue;

use App\Venue\ApiProcessor;

/**
 * @author Ino Monares <ino.monares@gmail.com>
 *
 * Weather API endpoint builder, via the Open Weather platform
 */
class Weather extends ApiProcessor
{
    /**
     * We initialize the `ApiProcessor` here for use in our API calls
     */
    public function __construct()
    {
        parent::__construct();
        $this->cacheScope = self::class;
        $this->baseUri = 'https://api.openweathermap.org';
    }

    /**
     * Get weather forecast based on city and country (code)
     * This API endpoint returns a significant list of forecast data, for now only 6 entries are important
     * We only need 6 entries for the display on the UI of the travel page, and the possible whole week forecast that a traveller might need.
     *
     * @param string $cityName
     * @param string $countryCode
     */
    public function getWeather($cityName, $countryCode)
    {
        // fetch the weather forecast
        // here, we have also specified the appid parameter from the OPENWEATHER API KEY - generated from the DEVELOPER portal
        $response = $this->getApi(
            sprintf(
                '/data/2.5/forecast?q=%s,%s&cnt=6&appid=%s',
                $cityName,
                $countryCode,
                env('OPENWEATHER_API_KEY')
            )
        );

        $weather = json_decode($response, true);

        // if we have successfully fetched a list of weather forecast
        // need to build also its `icon_link` - which is important to the travel page, that shows weather forecast easily through image icons (clear/cloudy/rainy)
        if (count($weather['list']) > 0) {
            foreach ($weather['list'] as $index => $forecast) {
                $weather['list'][$index]['weather'][0]['icon_link'] = sprintf('http://openweathermap.org/img/w/%s.png', $forecast['weather'][0]['icon']);
                $weather['list'][$index]['weather'][0]['formatted_date'] = date('m/d gA', strtotime($forecast['dt_txt']));
            }
        }

        return $weather['list'];
    }
}
