<?php
require_once('./vendor/autoload.php'); //line-bot-sdkの読み込み

$json = file_get_contents('php://input'); //LineBotへ送られてくるjsonファイル受け取り
$d_json = json_decode($json); //jsonファイルのデコード
$message = $d_json->events[0]->message->text; //Line Botへ送ったメッセージが入ってる
$replyToken = $d_json->events[0]->replyToken;

//↓[Channel Access Token]はLineDevelopper画面で自分のものを確認してください
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('[Channel Access Tok]');
//↓[channelSecret]にはLineDeveloper画面で自分のものを確認してください
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'channelSecret']);
//返答するメッセージを作成します
preg_match("/i have a ([a-zA-Z0-9]+), i have a ([a-zA-Z0-9]+)/", $message, $matches);
$res = "oh,\n".$matches[1].$matches[2];
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($res);
//返答の情報を作成します
$response = $bot->replyMessage($replyToken, $textMessageBuilder);

return;
