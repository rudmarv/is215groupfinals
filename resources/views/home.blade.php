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
                    $('#result').html('<img class="h-auto max-w-lg rounded-lg" src="https://is215finals.s3.amazonaws.com/'+response+'" alt="image description">');
                    $('#article-box').html('<button disabled type="button" class="py-2.5 px-5 me-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center"><svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/></svg>Generating Article ...</button>');
                    checkURL('https://is215finals.s3.amazonaws.com/articles/'+response+'-article.txt',10);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

    function checkURL(url, maxAttempts) {
  let attempts = 0;

  function fetchURL() {
    attempts++;
    console.log(`Generating Article...`);

    fetch(url)
      .then(response => {
        if (!response.ok) {
          // If response status is not ok but not 404, throw an error
          if (response.status !== 404) {
            throw new Error('Article is not yet ready...');
          }
        }
        return response.text();
      })
      .then(data => {
        $('#article-box').html(data);
      })
      .catch(error => {
        if (attempts < maxAttempts) {
          setTimeout(fetchURL, 5000); // Wait for 5 seconds before next attempt
        }
      })
      .finally(() => {
        if (attempts === maxAttempts) {
          console.log(`Exceeded maximum attempts (${maxAttempts}).`);
        }
      });
  }

  fetchURL();
}
</script>
</x-app-layout>
