<?php
ob_start();
define('API_KEY','api');
ini_set('error_reporting', 'E_ALL');

$botToken = "322361577:AAGhXi4Fl9oGcw9dXHpbKnH7DyDcy2lBmSI";
$webSite = "https://api.telegram.org/bot" . $botToken;

$update = file_get_contents("php://input");
$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

//$up = json_decode(file_get_contents('php://input'),true);
//get updates from webhook
$msg = $update['message'];
//get update type message
$callback = $update['callback_query'];
//get update type callback_query
$inline = $update['inline_query'];
//get update type inline_query



function sendMessage($chatId, $message, $reply)
{
    $url = $GLOBALS['webSite'] . "/sendMessage?chat_id=" . $chatId . "&text=" . urlencode($message) . "&reply_markup=" . $reply;
    file_get_contents($url);
}

switch ($message) {

 case "/start":
     //CustomKeyBord
     $option0 = array(array("ÓáÇã", "Úá?˜"));
     $replyMarkup0 = array(
      'keyboard' => $option0,
      'one_time_keyboard' => false,
      'resize_keyboard' => true,
      'selective' => true
     );
     $encodedMarkup = json_encode($replyMarkup0, 1);
     sendMessage($chatId, "ÔÑæÚ ã? ˜ä?ã", $encodedMarkup);
     break;

 case "ÓáÇã":
     //CustomKeyBord
     $option1 = array(array("ÎæÈ?¿", "ÎæÈ ä?ÓÊ?¿"), array("äã??¿", "Èå ãä ÑÈØ? äÏÇÑå¿"));
     $replyMarkup1 = array(
      'keyboard' => $option1,
      'one_time_keyboard' => false,
      'resize_keyboard' => true,
      'selective' => true
     );
     $encodedMarkup1 = json_encode($replyMarkup1, 1);

 sendMessage($chatId, "æ Úá?˜ã ÇáÓáÇã", $encodedMarkup1);
 break;


 case "ÎæÈ?¿":
     //CustomKeyBord1
     $replyMarkup3 =[
     'keyboard' =>[ [ [
         'text'=>'test',
         'request_contact'=>true,
         ]]],
     'resize_keyboard'=>true,
     'one_time_keyboard'=>true,
 ];
     $encodedMarkup = json_encode($replyMarkup3);


     sendMessage($chatId, "ÂÞÇ È?˜ÇÑ? ÈÑæ ÎæäÊæä",$encodedMarkup);
     break;

 case "ÎæÈ ä?ÓÊ?¿":
     //CustomKeyBord1
     $replyMarkup4 =[
     'inline_keyboard' =>[ [ [
         'text'=>'??????????test0',
         'callback_data'=>'test'  ,
         ],[
         'text'=>'??????????test00',
         'callback_data'=>'2'  ,
         ]],[ [
         'text'=>'test1',
         'callback_data'=>'c2'  ,
         ]]]

 ];
     $encodedMarkup55 = json_encode($replyMarkup4);


     sendMessage($chatId, "ÂÞÇ È?˜ÇÑ? ÈÑæ ÎæäÊæä",$encodedMarkup55);
     break;


 default:
 sendMessage($chatId, "chi migi ??", $encodedMarkup);

}


//function to send with curl its need php 5.5 or upper
function bot($method,$datas=[])
{
    $botToken = "322361577:AAGhXi4Fl9oGcw9dXHpbKnH7DyDcy2lBmSI";
    $webSite = "https://api.telegram.org/bot" . $botToken;

    $url =$webSite."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch))
    {
        var_dump(curl_error($ch));
    }
    else
    {
        return json_decode($res);
    }
}

 if(isset($callback)){
    //ansewr message typed callback
    if($callback['data'] == 'test')
    {
        bot('answerCallbackQuery',array('callback_query_id'=>$callback['id'],'text'=>"??Ç?æá ?˜??",'show_alert'=>true));//show notficatin
    }
    elseif($callback['data'] == '2')
    {
        bot('answerCallbackQuery',array('callback_query_id'=>$callback['id'],'text'=>'??Ç?æá 2??','show_alert'=>false));//show notficatin
    }
}



?>


