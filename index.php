<?php

$appid = "8e9af349-a501-49e0-9304-c34d67fb860e";
$tennantid = "3cc063bd-f081-4399-a70c-6706c16376d0";
$secret = "0e4f1b3d-f824-4fa8-835c-cfa33f8cd8b3";
$login_url = "https://login.microsoftonline.com/". $tennantid ."/oauth2/v2.0/authorize";


session_start();
$_SESSION['state'] = session_id();
echo "<h1>MS OAuth2.0 Demo </h1><br>";
if (isset ($_SESSION['msatg'])) {
    echo "<h2>Authenticated " . $_SESSION["uname"] . " </h2><br> ";
    echo '<p><a href="?action=logout">Log Out</a></p>';
} //end if session
else   echo '<h2><p>You can <a href="?action=login">Log In</a> with Microsoft</p></h2>';

if ($_GET['action'] == 'login') {
    $params = array('client_id' => $appid,
        'redirect_uri' => 'https://bit-workboard.000webhostapp.com/',
        'response_type' => 'token',
        'scope' => 'https://graph.microsoft.com/User.Read',
        'state' => $_SESSION['state']);
    header('Location: ' . $login_url . '?' . http_build_query($params));

}

echo '

<script> url = window.location.href;

i=url.indexOf("#");

if(i>0) {

 url=url.replace("#","?");

 window.location.href=url;}

</script>

';


if (array_key_exists('access_token', $_GET)) {

    $_SESSION['t'] = $_GET['access_token'];

    $t = $_SESSION['t'];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $t,

        'Conent-type: application/json'));

    curl_setopt($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $rez = json_decode(curl_exec($ch), 1);

    if (array_key_exists('error', $rez)) {

        var_dump($rez['error']);

        die();

    } else {

        $_SESSION['msatg'] = 1;  //auth and verified

        $_SESSION['uname'] = $rez["displayName"];

        $_SESSION['id'] = $rez["id"];


    }
    curl_close($ch);
    header('Location: https://bit-workboard.000webhostapp.com/');
}


if ($_GET['action'] == 'logout') {
    unset ($_SESSION['msatg']);
    header('Location: https://bit-workboard.000webhostapp.com/');
}