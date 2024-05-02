<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GetArticleController extends Controller
{
    public function getArticle($awsurl)
    {
        $client = new Client();
        $attempts = 0;

        $checkUrl = function () use ($client, $awsurl, &$attempts, &$checkUrl) {
            $attempts++;
            $response = $client->get($awsurl, ['http_errors' => false]);

            if ($response->getStatusCode() === 200) {
                return response()->json(['message' => 'available']);
            }

            if ($attempts < 10) {
                sleep(5); // 5-second delay
                return $checkUrl(); // Recursive call
            }

            return response()->json(['message' => 'URL is not accessible'], 404);
        };

        return $checkUrl();
    }
}
