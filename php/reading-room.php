<?php
require '../vendor/autoload.php'; // Ensure the path to autoload.php is correct

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

// Initialize Guzzle Client with SSL verification disabled
$client = new Client([
    'verify' => false,
]);

// List of URLs to scrape
$urls = [
    'https://www.wri.org/insights/why-preserving-forest-integrity-preventing-deforestation?utm_medium=referral+&utm_source=GFWBlog&utm_campaign=GFWBlog%22target=%22_blank',
    'https://www.wri.org/insights/indigenous-peoples-local-communities-use-satellite-data-deforestation',
    'https://www.wri.org/insights/worlds-last-intact-forests-increasingly-fragmented',
    'https://www.wri.org/insights/why-preserving-forest-integrity-preventing-deforestation',
    'https://www.wri.org/insights/global-trends-forest-fires?utm_medium=referral+&utm_source=GFWBlog&utm_campaign=GFWBlog%22target=%22_blank',
    'https://www.wri.org/insights/forests-absorb-twice-much-carbon-they-emit-each-year',
];

// Function to scrape a single article
function scrapeArticle($url) {
    global $client;

    try {
        // Fetch the page content
        $response = $client->request('GET', $url);
        $html = $response->getBody()->getContents();

        // Initialize DomCrawler
        $crawler = new Crawler($html);

        // Adjust selectors based on the actual HTML structure of the blog pages
        $title = $crawler->filter('h1')->first()->text();
        $content = $crawler->filter('div.article-content')->count() > 0
            ? $crawler->filter('div.article-content')->text()
            : $crawler->filter('article')->text(); // Fallback to another common structure
        $image = $crawler->filter('meta[property="og:image"]')->count() > 0
            ? $crawler->filter('meta[property="og:image"]')->attr('content')
            : ''; // Extract cover image URL

        return [
            'title' => $title,
            'url' => $url,
            'content' => substr(strip_tags($content), 0, 150) . '...', // Shortened content length
            'image' => $image // Include cover image URL
        ];
    } catch (\Exception $e) {
        return [
            'title' => 'Error',
            'url' => $url,
            'content' => 'Error scraping article: ' . htmlspecialchars($e->getMessage()),
            'image' => '' // No image in case of error
        ];
    }
}

// Scrape all articles and store results
$articles = [];
foreach ($urls as $url) {
    $article = scrapeArticle($url);
    if ($article) {
        $articles[] = $article;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading Room - Blogs</title>
    <style>
        /* Importing Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap');

        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EDEDE6;
            color: #333;
            padding: 20px;
            padding-top: 80px; /* Space between header and content */
        }

        h1 {
            font-family: 'Abril Fatface', serif;
            font-size: 40px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .blogs {
            display: flex;
            flex-wrap: nowrap; /* Horizontally aligned */
            overflow-x: auto; /* Allow horizontal scroll */
            gap: 20px;
            margin-top: 100px;
        }

        .blog {
            background-color: #cddad4;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            flex: 0 0 auto; /* Prevent flex item from growing or shrinking */
            width: 300px; /* Fixed width for horizontal layout */
            display: flex;
            flex-direction: column;
        }

        .blog img {
            width: 100%;
            height: auto;
            display: block;
        }

        .blog-content {
            padding: 20px;
            flex-grow: 1;
        }

        .blog-content h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .blog-content p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #666; /* Slightly lighter color for the description */
        }

        .blog-footer {
            padding: 20px;
            background-color: #f4f4f4;
            text-align: right;
        }

        .read-more {
            text-decoration: none;
            color: #354e51;
            font-weight: 600;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .blog {
                width: 100%; /* Adjust width for smaller screens */
            }
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <?php include 'headerwithmenu.php'; ?>
    <div class="container">
        <div class="blogs">
            <?php
            if (!empty($articles)) {
                foreach ($articles as $article) {
                    echo '<div class="blog">';
                    if (!empty($article['image'])) {
                        echo '<img src="' . htmlspecialchars($article['image']) . '" alt="Blog Image">';
                    }
                    echo '<div class="blog-content">';
                    echo '<h2>' . htmlspecialchars($article['title']) . '</h2>';
                    echo '<p>' . htmlspecialchars($article['content']) . '</p>';
                    echo '</div>';
                    echo '<div class="blog-footer">';
                    echo '<a href="' . htmlspecialchars($article['url']) . '" class="read-more" target="_blank">Read More</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No blogs found.</p>';
            }
            ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
