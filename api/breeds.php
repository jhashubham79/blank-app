<?php
header('Content-Type: application/json');

$url = "https://api.thecatapi.com/v1/breeds";

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
    echo json_encode(["error" => "Failed to fetch breeds"]);
    exit;
}

echo $response;
