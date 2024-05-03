<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View All Articles') }}
        </h2>
    </x-slot>
    <div id="articles"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to fetch JSON data for each file
            async function fetchArticleData(file) {
                try {
                    const url = `https://is215finals.s3.amazonaws.com/articles/${file}-article.json`;
                    const response = await axios.get(url);
                    return response.data;
                } catch (error) {
                    console.error("Error fetching article data:", error);
                    return null;
                }
            }

            // Function to render articles
            async function renderArticles() {
                const files = <?php echo json_encode($files); ?>;

                const articlesContainer = document.getElementById("articles");

                for (const file of files) {
                    // Create div for each article
                    const articleDiv = document.createElement("div");
                    articleDiv.classList.add("w-4/12", "overflow-hidden");

                    // Create image element
                    const img = document.createElement("img");
                    img.classList.add("w-full", "max-w-lg", "rounded-lg", "mb-6");
                    img.src = `https://is215finals.s3.amazonaws.com/${file}`;
                    img.alt = "image description";
                    articleDiv.appendChild(img);

                    // Fetch JSON data and render article content
                    const jsonData = await fetchArticleData(file);
                    if (jsonData) {
                        const articleTitle = document.createElement("h2");
                        articleTitle.classList.add("mb-4", "text-3xl", "font-extrabold", "leading-tight", "text-gray-900", "lg:mb-6", "lg:text-4xl");
                        articleTitle.textContent = jsonData.title;

                        const articleContent = document.createElement("p");
                        articleContent.classList.add("text-gray-500");
                        articleContent.textContent = jsonData.article;

                        const articleContentDiv = document.createElement("div");
                        articleContentDiv.classList.add("w-full", "overflow-hidden");
                        articleContentDiv.appendChild(articleTitle);
                        articleContentDiv.appendChild(articleContent);

                        articleDiv.appendChild(articleContentDiv);
                    }

                    // Append article div to container
                    articlesContainer.appendChild(articleDiv);
                }
            }

            // Call renderArticles function when document is ready
            renderArticles();
        });
    </script>
</x-app-layout>
