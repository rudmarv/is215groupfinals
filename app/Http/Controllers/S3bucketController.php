<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Aws\S3\S3Client;

class S3bucketController extends Controller
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

    public function listArticles()
    {
        // Create an S3 client
        $s3Client = new S3Client([
            'region' => 'us-east-1',
            'version' => '2006-03-01'
        ]);

        // Set the bucket name
        $bucketName = 'is215finals';

        try {
            // List all objects in the bucket
            $objects = $s3Client->listObjectsV2([
                'Bucket' => $bucketName,
            ]);

            // Extract filenames from the object list excluding directories
            $files = array_filter(array_map(function ($object) {
                return strpos($object['Key'], '/') === false ? $object['Key'] : null;
            }, $objects['Contents']));
            
            return view('articles', ['files' => $files]);
        } catch (AwsException $e) {
            // Handle exceptions
            echo "error";
        }
    }
}
