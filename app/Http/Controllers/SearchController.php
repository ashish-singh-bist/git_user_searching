<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JsValidator;
use Illuminate\Support\Facades\Input;
use App\CustomServices\HttpGit;

class SearchController extends Controller
{
    public function __construct(HttpGit $HttpGit)
    {
      $this->HttpGit = $HttpGit;
    }

		function index()
		{
			return view('index')->with(['current_page' => 1, 'total_page' => 0]);
		}

    function search(Request $request)
		{
			$page = (int)$request->current_page;
			if($request->old_search_term != '' && $request->old_search_term != $request->search_term){
				$page = 1;
			}
			$api_res = $this->HttpGit->search($request->search_term,$page);
			$response_json = array();
			if($api_res['status']){
				$response_json = json_decode($api_res['res'],true);
				if(count($response_json['items']) > 1){
					$total_page = ceil($response_json['total_count']/30);
					Input::flash();
					return view('index')->with(['users' => $response_json['items'], 'current_page' => $page, 'total_page' => $total_page]);
				}
				elseif(count($response_json['items']) == 1){
					return redirect()->route('profile',['profile_url' => $response_json['items'][0]['url']]);
				}
				else{
					Input::flash();
					return view('index')->with(['users' => [], 'current_page' => 1, 'total_page' => 0]);
				}
			}
			else{
				flash($api_res['msg'])->error()->important();
				return view('index')->with(['current_page' => 1, 'total_page' => 0]);
			}
		}

    function viewProfile(Request $request)
		{
			$api_res = $this->HttpGit->getPage($request->profile_url);
			if($api_res['status']){
				return view('user_profile')->with(['user' => $api_res['res']]);
			}
			else{
				flash($api_res['msg'])->error()->important();
				return view('index')->with(['current_page' => 1, 'total_page' => 0]);
			}
		}

    function loadFollower(Request $request)
		{
			$api_res = $this->HttpGit->getPage($request->url);
			return response()->json($api_res['res']);
		}


}
