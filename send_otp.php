<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pprkmm.api.infobip.com/2fa/2/pin?ncNeeded=true',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"applicationId":"EC5246F18DDDAAD2CE5C37ACC6C22F05","messageId":"17827C18352819BCD5DC327CAA2F33CD","from":"lockverify","to":"254758885970","placeholders":{}}',
    CURLOPT_HTTPHEADER => array(
        'Authorization: App 1cfb78ba9e0d7ab7c41c84a06bfd886d-0b29774d-24ee-41ef-942e-22d1f8310330',
        'Content-Type: application/json',
        'Accept: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>