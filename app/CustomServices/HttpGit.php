<?php

namespace App\CustomServices;

use GuzzleHttp\Client;

class HttpGit
{
		protected $url;
    public function __construct(Client $guzzle_client)
    {
      $this->guzzle_client = $guzzle_client;
			$this->git_user = \Config::get('app.git_user');
			$this->git_pass = \Config::get('app.git_pass');
			$this->url = 'https://api.github.com/search/users?q=';
    }		

    public function search($search_term,$page) 
    {
			//api request to get search user on git
			try{
				if($this->git_user != '' && $this->git_pass != ''){
					$guj_request = $this->guzzle_client->request('GET',  $this->url . urlencode($search_term) . "&page=" . $page, [
							'auth' => [$this->git_user, $this->git_pass]
					]);					
				}
				else{
					$guj_request = $this->guzzle_client->get( $this->url . urlencode($search_term) . "&page=" . $page);	
				}
			}
			catch(\GuzzleHttp\Exception\RequestException $exception) {
				return ['status' => false, 'msg' => "Something went wrong or Only the first 1000 search results are available."];
			}
			if($guj_request->getStatusCode() == 200){
				$res = $guj_request->getBody();																			  // Get the actual response without headers
				$res_json = json_decode($res, true);
				return ['status' => true, 'res' => $res];
			}
			else{
				return ['status' => false, 'msg' => "Something went wrong try again. If error persist contact admin.",  'status_code' => $guj_request->getStatusCode()];
			}
    }

    public function getPage($url) 
    {
			try{
				if($this->git_user != '' && $this->git_pass != ''){
					$guj_request = $this->guzzle_client->request('GET',  $url, [
							'auth' => [$this->git_user, $this->git_pass]
					]);
				}
				else{
					$guj_request = $this->guzzle_client->get( $url );	
				}
			}
			catch(\GuzzleHttp\Exception\RequestException $exception) {
				return ['status' => false, 'msg' => "Something went wrong or API rate limit exceeded, try again later."];
			}
			if($guj_request->getStatusCode() == 200){
				$res = $guj_request->getBody();																			  // Get the actual response without headers
				$res_json = json_decode($res, true);
				return ['status' => true, 'res' => $res_json];
			}
			return ['status' => false, 'msg' => "Error to get data. Contact admin."];
		}

}
