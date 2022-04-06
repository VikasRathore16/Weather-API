<?php

use Phalcon\Mvc\Controller;

class LocationController extends Controller
{

    public function currentWeatherAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->get('location');
            $response = $this->find('current.json?key=', $this->config->get('api')['api_key'], '&q=' . $location);
            $this->view->location = $response;
        }
    }

    public function forecastAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->get('location');
            $response = $this->find('forecast.json?key=', $this->config->get('api')['api_key'], '&q=' . $location.'&days=2');
            $this->view->location = $response;
            // echo "<pre>";
            // print_r($response);
            // die();
        }
    }

    public function timezoneAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->get('location');
            $response = $this->find('timezone.json?key=', $this->config->get('api')['api_key'], '&q=' . $location);
            $this->view->location = $response;
            // echo "<pre>";
            // print_r($response);
            // die();
        }
    }

    public function sportsAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->get('location');
            $response = $this->find('sports.json?key=', $this->config->get('api')['api_key'], '&q=' . $location);
            $this->view->location = $response;
            echo "<pre>";
            print_r($response);
            die();
        }
    }

    public function astronomyAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->get('location');
            $response = $this->find('astronomy.json?key=', $this->config->get('api')['api_key'], '&q=' . $location);
            $this->view->location = $response;
            echo "<pre>";
            print_r($response);
            die();
        }
    }

    public function weatherAlertsAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->get('location');
            $response = $this->find('forecast.json?key=', $this->config->get('api')['api_key'], '&q=' . $location . '&alerts=yes');
            $this->view->location = $response;
            echo "<pre>";
            print_r($response);
            die();
        }
    }

    public function airQualityAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->get('location');
            $response = $this->find('forecast.json?key=', $this->config->get('api')['api_key'], '&q=' . $location . '&aqi=yes');
            $this->view->location = $response;
            echo "<pre>";
            print_r($response);
            die();
        }
    }


    private function find($query = '', $slug = '', $format = '')
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $this->config->get('api')['base_url'] . $query . $slug . $format);
        $response = (object)(json_decode($response->getBody(), true));
        return $response;
    }
}
