<form method="POST" action='{{ url("/s3upload") }}' enctype="multipart/form-data">
        @csrf

        
    <label class="block mb-2 text-sm font-medium text-gray-900" for="multiple_files">Upload Image</label>
    <input name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="multiple_files" type="file" multiple>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Upload</button>
    </form>