<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload to S3bucket') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="flex max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg">
            <div class=" w-1/2 overflow-hidden ">
                <div class="p-6 text-gray-900">
                <form id="upload-form" enctype="multipart/form-data">
                    @csrf
                    <p class="tracking-tighter text-gray-500 md:text-lg pb-6">This form enables you to upload an image file for AI image recognition using Amazon Rekognition for detailed visual analysis. It will also generate an article on the supplied image using ChatGPT's article producing feature.</p>
                <input id="image" name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" accept="image/png, image/jpeg, image/jpg" required type="file">
                

                <button id="uploadBtn" type="submit" class="text-white bg-blue-700 mt-2 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Upload and Generate Content</button>
                </form>
                </div>
                

            </div>
            <div class=" w-1/2 overflow-hidden ">
                <div class="p-6 text-gray-900">
                    <p class="tracking-tighter text-gray-500 md:text-lg pb-6">Result:</p>
                    <div id="result"></div>
                    <div id="article-box"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        
    $(document).ready(function() {
        $('#uploadBtn').click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('file', $('#image')[0].files[0]);
            formData.append('_token', $('input[name=_token]').val()); // CSRF token

            $.ajax({
                type: 'POST',
                url: '{{ route("s3upload") }}', // Replace with your route name
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#result').html('<img class="h-auto max-w-lg rounded-lg mb-6" src="https://is215finals.s3.amazonaws.com/'+response+'" alt="image description">');
                    $('#article-box').html('<div class="timeline-wrapper"><div class="animated-background text-gray-600 h-7 w-1/2 px-1 rounded-md mb-2">Generating article using ChatGPT</div><div class="animated-background h-3 w-3/4 rounded-sm mb-2"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-1/2 rounded-sm mb-6"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-3/4 rounded-sm mb-6"></div><div class="animated-background h-3 w-full rounded-sm mb-2"></div><div class="animated-background h-3 w-1/2 rounded-sm mb-2"></div></div>');
                    checkArticle('https://is215finals.s3.amazonaws.com/articles/'+response+'-article.json');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

    function checkArticle(awsurl) {
        $(document).ready(function() {
            $.ajax({
                url: '/get-article',
                type: 'GET',
                data: {url: awsurl},
                success: function(response) {
                    $('#article-box').html(response.message);
                },
                error: function(xhr, status, error) {
                    $('#article-box').html("Unable to generate Article. Try to upload again.");
                }
            });
        });
    }
</script>
</x-app-layout>
