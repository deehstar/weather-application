# Simple Weather App

A simple weather application built with Laravel 11, which fetches real-time and historical weather data using [WeatherAPI](https://www.weatherapi.com/docs/). The app allows users to view current weather conditions, a historical archive of weather data, and detailed forecasts.

---

## **Contents**
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
---

## **Requirements**
- PHP 8.1+
- Composer
- Laravel 11
- SQLite database
- WeatherAPI account for API key

---

## **Installation**

1. **Clone the repository**:
   ```bash
   git clone https://github.com/deehstar/weather-application.git
   cd <project-folder>
   ```
2. **Install composer**:
   ```bash
   composer install
   ```
## **Configuration**

3. **Add API key to .env file**:
   - Create an API key from www.weatherapi.com/
   - Add the key to the .env file
   ```
   WEATHER_API_KEY={Your-api-key}
   ```
   - Save the .env file before the next step
4. **Generate encryption key**
   ```bash
   php artisan key:generate
   ```
5. **Migrate database**
   ```bash
   php artisan migrate
   ```
## **Usage**

- **Fetch initial data for database**
   ```bash
   php artisan fetchWeatherData
   ```
- **Start application**
  ```bash
  php artisan serve
  ```
- **Start scheduler**
  Open another terminal and run
  ```bash
  php artisan schedule:work
  ```
  This will start a scheduled command that fetches data for the database 
  every 5 minutes.
