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
                <input id="image" name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required id="multiple_files" type="file">
                

                <button id="uploadBtn" type="submit" class="text-white bg-blue-700 mt-2 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Upload and Generate Content</button>
                </form>
                </div>
                

            </div>
            <div class=" w-1/2 overflow-hidden ">
            <div class="p-6 text-gray-900">
            <p class="tracking-tighter text-gray-500 md:text-lg pb-6">Result:</p>
            <div id="result"></div>
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
                    $('#result').html('<img class="h-auto max-w-lg rounded-lg" src="https://is215finals.s3.amazonaws.com/'+response+'" alt="image description">');
                    // checkLink()
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

    // function checkLink(link, maxAttempts) {
    // let attempts = 0;

    // function fetchLink() {
    //     attempts++;
    //     console.log(`Attempt ${attempts}: Checking link...`);

    //     fetch(link)
    //     .then(response => {
    //         if (!response.ok) {
    //         throw new Error('Network response was not ok');
    //         }
    //         return response.text();
    //     })
    //     .then(data => {
    //         console.log(`Link status: OK - Response: ${data}`);
    //     })
    //     .catch(error => {
    //         console.error(`Error: ${error.message}`);
    //     })
    //     .finally(() => {
    //         if (attempts < maxAttempts) {
    //         setTimeout(fetchLink, 5000); // Wait for 5 seconds before next attempt
    //         }
    //     });
    // }

    // fetchLink();
    // }
</script>
</x-app-layout>
