<?php


require "vendor/autoload.php";


use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'uD9Shmh5aRFwxE2wfCUMkm0HU');
define('CONSUMER_SECRET', 'RWv4ZtV1zotPwH8JC2ySZLKyT2nTgLnF4qsGWgyf2FSjahQzan');
define('ACCESS_TOKEN', '331880742-ODGpX5liDATC23dmqPZ99e20kkWwao8JtfXrWwZN');
define('ACCESS_TOKEN_SECRET', 'QbfQyrwWSYYI7eGkvlcUGk4uI1Jv8RaQNKOaeSK6nOlis');


$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);


$query = array(
  "q" => "#NationalBestFriendsDay",
  "count" => "40"
);

$results = $toa->get('search/tweets', $query);


/*echo "<pre>";
echo highlight_string(var_export($results, true));
echo "</pre>";*/

foreach ($results->statuses as $result) {

	$display = $result->user->screen_name . ': ' . $result->text;

	if(!empty($result->entities->media[0]->media_url)){
		$display .= ': <img src="'.$result->entities->media[0]->media_url.'"><br>';
	} else{
		$display .= '<br>';
	}
	echo $display;
/*	    $media_size_h = $result->entities->media->sizes->small->h;
    $media_size_w = $result->entities->media->sizes->small->w;*/
}

/*$result->user->screen_name . ': ' . $result->text .': <img src="'.$result->entities->media[0]->media_url.'"><br>';*/




if (isset($_GET["error"]))
{
    echo("<pre>OAuth Error: " . $_GET["error"]."\n");
    echo('<a href="index.php">Retry</a></pre>');
    die;
}

$authorizeUrl = 'https://ssl.reddit.com/api/v1/authorize';
$accessTokenUrl = 'https://ssl.reddit.com/api/v1/access_token';
$clientId = 'QjEbOhlMbo569w';
$clientSecret = 'r-C2hJCYZoXmqWMwtEiuq1e2dJY';
$userAgent = 'ChangeMeClient/0.1 by YourUsername';

$redirectUrl = "http://localhost/keepitup/index.php";


$client = new OAuth2\Client($clientId, $clientSecret, OAuth2\Client::AUTH_TYPE_AUTHORIZATION_BASIC);
$client->setCurlOption(CURLOPT_USERAGENT,$userAgent);

if (!isset($_GET["code"]))
{
    $authUrl = $client->getAuthenticationUrl($authorizeUrl, $redirectUrl, array("scope" => "identity", "state" => "SomeUnguessableValue"));
    header("Location: ".$authUrl);
    die("Redirect");
}
else
{
    $params = array("code" => $_GET["code"], "redirect_uri" => $redirectUrl);
    $response = $client->getAccessToken($accessTokenUrl, "authorization_code", $params);

    $accessTokenResult = $response["result"];
    $client->setAccessToken($accessTokenResult["access_token"]);
    $client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);

    $responses = $client->fetch("http://www.reddit.com/search.json?q=picture&limit=40");
    $children = $responses['result']['data']['children'];


/*    echo('<strong>Response for fetch me.json:</strong><pre>');
    var_dump($responses);
    echo('</pre>');*/

		foreach ($children as $child){
    	echo $child['data']['title'].'<br>';
    	if(!empty($child['data']['preview']['images'][0]['resolutions'][0]['url'])){
    	echo '<img src="'.$child['data']['preview']['images'][0]['resolutions'][1]['url'].'"><br>';
    }
    	echo $child['data']['selftext'].'<br><hr>';
    }
}
