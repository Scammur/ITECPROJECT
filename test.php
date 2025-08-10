<?php
$notifUrl = "https://mrdeath1291.pythonanywhere.com/notification";

// Fetch the content with error handling
$notifRaw = file_get_contents($notifUrl);

if ($notifRaw === false) {
    die("Failed to fetch data from URL.");
}

// Decode the JSON response
$notifData = json_decode($notifRaw, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON decode error: " . json_last_error_msg());
}

// Check if 'data' key exists
if (!isset($notifData['data']) || !is_array($notifData['data'])) {
    die("'data' key missing or not an array in JSON response.");
}

// Loop through data and echo items
foreach ($notifData['data'] as $d) {
    if (isset($d['item'])) {
        echo htmlspecialchars($d['item']) . "<br>";
    }
}
?>
