<?php

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{

    public function indexAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->getPost('location');
            $response = $this->find('search.json?key=', $this->config->get('api')['api_key'], '&q=' . $location);
            $this->view->locations = $response;
        }
    }

    public function currentLocationAction()
    {
        if ($this->request->has('location')) {
            $location = $this->request->get('location');
            $response = $this->find('current.json?key=', $this->config->get('api')['api_key'], '&q=' . $location);
            $this->view->location = $response;
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
