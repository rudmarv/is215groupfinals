<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;

class S3uploadController extends Controller
{
    public function index(){
        $s3Client = new S3Client([
            'region' => 'us-east-1',
            'version' => '2006-03-01'
        ]);

        //Listing all S3 Bucket
        $buckets = $s3Client->listBuckets();
        foreach ($buckets['Buckets'] as $bucket) {
            echo $bucket['Name'] . "\n";
        }
        return view('s3upload');

    }

    public function store(Request $request){
        $file = $request->file('file');
        $s3 = new S3Client([
            'region' => 'us-east-1',
            'version' => '2006-03-01'
        ]);

        $result = $s3->putObject([
            'Bucket' => 'is215finals',
            'Key'    => time() . $file->getClientOriginalName(),
            'Body'   => fopen($file, 'r'),
            //'ACL'    => 'public-read',
        ]);

        // Get the URL of the uploaded image
        $resurls = $result['body'];
        echo $resurls;


    }
    // public function store(Request $request)
    // {
    // $s3Client = new S3Client([
    //     'region' => 'us-east-1',
    //     'version' => '2006-03-01'
    // ]);
        
    
    // if ($request->hasFile('file')) {
    // $file = $request->file('file');
    // $fileName = time() . $file->getClientOriginalName();
    // echo $file;
    
    // echo "<br>"
    // echo $fileName;
    // try {
    //     $s3Client->putObject([
    //         'Bucket' => 'is215finals',
    //         'Key' => $fileName,
    //         'SourceFile' => $file
    //     ]);
    //     echo "Uploaded $fileName to $this->bucketName.\n";
    // } catch (Exception $exception) {
    //     echo "Failed to upload $fileName with error: " . $exception->getMessage();
    //     exit("Please fix error with file upload before continuing.");
    // }
    // echo "loob";
    // }
    // else {
    // echo "dulo";
    // }
 


    // }
}