<?php

$router->get('/', function () {
    if (isset($_SESSION['student'])) {
        require_once "views/home.php";
        return str_replace("{{ studentInfo }}", json_encode($_SESSION['student']), $content);
    } else {
        require_once "views/connection.php";
        return $content;
    }
});

$router->get('/oauth/authorize', function () {
    $clientId = getenv('API_CLIENT_ID');

    return header('Location: https://etu.utt.fr/api/oauth/authorize?client_id='.$clientId.'&scopes=public&response_type=code&state=xyz');
});

$router->get('/oauth/callback', function () {
    if (!isset($_GET['authorization_code'])) {
        return header('HTTP/1.0 403 Forbidden');
    }

    $client = new \GuzzleHttp\Client([
        'base_uri' => 'https://etu.utt.fr',
        'auth' => [
            getenv('API_CLIENT_ID'),
            getenv('API_CLIENT_SECRET'),
        ],
    ]);

    $params = [
        'grant_type' => 'authorization_code',
        'authorization_code' => $_GET['authorization_code'],
    ];

    try {
        $response = $client->post('/api/oauth/token', ['form_params' => $params]);
    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        // An error 400 from the server is usual when the authorization_code
        // has expired. Redirect the user to the OAuth gateway to be sure
        // to regenerate a new authorization_code for him :-)
        if ($e->getResponse()->getStatusCode() === 400) {
            die(header('Location: /oauth/authorize'));
        }

        return header('HTTP/1.1 500 Internal Server Error');
    }

    $json = json_decode($response->getBody()->getContents(), true);

    try {
        // Yes. $json['response']['access_token']. Hope it'll be fixed in the v2 :-)
        $response = $client->get('/api/public/user/account?access_token='.$json['response']['access_token']);
    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        return header('HTTP/1.1 500 Internal Server Error');
    }

    $json = json_decode($response->getBody()->getContents(), true)['response']['data'];

    $_SESSION['student'] = $json;

    return header('Location: /');
});

// Safely logout the user, by remving his cookie and all the datas belonging to
// his session.
$router->get('/logout', function () {
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();

    return header('Location: /');
});

$router->post('/submit', function () {
    return 'It works';
});
