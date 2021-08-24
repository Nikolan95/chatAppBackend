<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        //return $request;
        try
        {
            $http = new \GuzzleHttp\Client;
            $dev_url = 'http://localhost/atev-laravel-backend/public/oauth/token';
            $live_url = 'http://195.4.160.243/oauth/token';

            $response = $http->post($dev_url, [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => '03fvumlOHkSGQExG479UekN8k8arR38Ll8uqGroG',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ],       
            ]);
            return json_decode((string) $response->getBody(), true);

        }
        catch(\GuzzleHttp\Exception\BadResponseException $e)
        {
            //return response()->json('errors', $e->getCode());
            switch ($e->getCode()) {
                case 400:
                case 401:
                    return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
                break;
                default:
                    return response()->json('Something went wrong on the server', $e->getCode());
            }
        }
    }
    public function logout()
    {
        auth()->user()->tokens->each(function($token){
            $token->delete();
        });
        return response()->json('logout successfully', 200);
    }
}
