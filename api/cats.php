<?php
header('Content-Type: application/json');

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$breed = isset($_GET['breed_id']) ? $_GET['breed_id'] : '';

$url = "https://api.thecatapi.com/v1/images/search?limit=$limit";
if (!empty($breed)) {
    $url .= "&breed_ids=" . urlencode($breed);
}

$options = [
    "http" => [
        "method" => "GET",
        "header" => "Accept: application/json\r\n"
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === FALSE) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to fetch cat images"]);
    exit;
}

echo $response;
