# Introduction
This is a project built under Laravel - using the base environment [here](https://github.com/aschmelyun/docker-compose-laravel)

This app aims to be able to give weather information and venue suggestions for travellers - travelAHHR.

## Installation 

### Prerequisites
Stable Docker version installed on local machine and a little of CLI knowledge

### Steps

Easy installation is as follows:

1. Clone repo via git into your local machine
2. Open a CLI (CLI/powershell/bash) on your machine, and navigate to the project directory.
3. Execute docker compose commands

### Commands

```bash
# setup the project
mkdir travelahr_laravel
cd travelahr_laravel
git clone git@github.com:inomon/travelahr_laravel.git .

# initialize the container and setup the project
docker-compose up -d --build travelahr_site
docker-compose up -d --build travelahr_composer
docker-compose run --rm travelahr_composer install
```

## Background of Build
This project is based off on the tool sets listed here:

- https://github.com/aschmelyun/docker-compose-laravel

### Development Environment
Using `docker-compose-laravel` I was able to prepare a LOCAL working environment for the app. Going forward, this toolkit will help tremendously since it is a fullstack docker & laravel build.

# Usage
Coding exam

## Requirements
Create a simple information web app for tourists. You can use Laravel with VueJS or OOP PHP + Javascript framework (JQuery/ES6/ES5)

## Project Scope
This page aims to provide travel information of Japan for foreign tourists visiting Japan for the first time.
The traveler has the possibility of going to the following cities.
Tokyo, Yokohama, Kyoto, Osaka, Sapporo, Nagoya

## Solution
Created project using Laravel, by implementing library classes that fetches data from the required API endpoints. Processing the data through services and making sure important logic is not scatterd on Controllers.
To alleviate strain on API fetch overload - hence using the free tier - a caching also was implemented to make sure that each new API fetch can be preserved for an ample time.
To be used in the future if needed (TTL = 120 seconds).

## Design & Development
I chose the look and feel of the template, based on a existing free bootstrap template, that emcompasses the simple yet straightforward mission of the app. And its ready to implement responsive layout is a welcome feature.

The only form, has the required list of locations for now, but its build is open for the possibility of creating a searchable field on universal locations (not limited to Japan). It is also located at different key points of the app for accessibility: landing page header, landing page footer, venue listing page top bar.

On the weather forecast section, I retained the weather icons provided by OpenWeather. Since those are already very descriptive, I've included only the weather description and the timestamp. This shows in a glance a timeline of the weather.

I used simple classes that call the endpoints for each service that we need which gets digested into a simple array. This simple array is then fed to the view templates with the sole purpose of displaying content. All other transactions for building the data is only left on libraries. While the controller is just dispatching the needed library to use and feeding the returned data into our template. This is a starting point for an example of making sure that we follow the most basic principle of MVC.
