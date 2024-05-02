<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GetArticleController extends Controller
{
    public function getArticle()
    {
        $awsurl = request()->input('url');
        $client = new Client();
        $attempts = 0;

        $checkUrl = function () use ($client, $awsurl, &$attempts, &$checkUrl) {
            $attempts++;
            $response = $client->get($awsurl, ['http_errors' => false]);

            if ($response->getStatusCode() === 200) {
                $content = $response->getBody()->getContents();
                return response()->json(['message' => $content]);
            }

            if ($attempts < 25) {
                sleep(2); // 5-second delay
                return $checkUrl(); // Recursive call
            }

            return response()->json(['message' => 'URL is not accessible'], 404);
        };

        return $checkUrl();
    }
}
