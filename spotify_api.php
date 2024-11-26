<?php
function getSpotifyToken() {
    $client_id = "79abc9fc3b6940b6879cc23e83197103"; // Reemplaza con tu Client ID.
    $client_secret = "7a3a68adc0e544ad8957c88de71a8d15"; // Reemplaza con tu Client Secret.

    $url = "https://accounts.spotify.com/api/token";
    $data = [
        "grant_type" => "client_credentials"
    ];

    $headers = [
        "Authorization: Basic " . base64_encode("$client_id:$client_secret")
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $json_response = json_decode($response, true);

    return $json_response['access_token'];
}

// Función para buscar canciones en Spotify
function searchSpotifyTrack($query) {
    $token = getSpotifyToken();
    $url = "https://api.spotify.com/v1/search?type=track&q=" . urlencode($query);

    $headers = [
        "Authorization: Bearer $token"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
?>