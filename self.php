<?php

ini_set('memory_limit', '2048M');
if(!is_dir('files')){
mkdir('files');
}
if(!file_exists('madeline.php')){
copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
if(!file_exists('online.txt')){
file_put_contents('online.txt','off');
}
include 'madeline.php';
$settings = [];
$settings['logger']['max_size'] = 5*1024*1024;
$MadelineProto = new \danog\MadelineProto\API('MYOJ.madeline', $settings);
$MadelineProto->start();
if(file_get_contents('online.txt') == 'on'){
$MadelineProto->account->updateStatus(['offline' => false]);
}
function closeConnection($message = '𝓼𝓸𝓫𝓱𝓪𝓷 SELF Is Runinng...<br>@sbi_pv')
{
if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
return;
}
  @ob_end_clean();
  header('Connection: close');
  ignore_user_abort(true);
  ob_start();
  echo '<html><body><h1 style="margin-top:50px; text-align:center; color:white; text-shadow:1px 1px 15px black;">'.$message.'</h1></body</html>';
  $size = ob_get_length();
  header("Content-Length: $size");
  header('Content-Type: text/html');
  ob_end_flush();
  flush();
  $GLOBALS['exited'] = true;
}
function shutdown_function($lock)
{
  $a = fsockopen((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls' : 'tcp').'://'.$_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
  fwrite($a, $_SERVER['REQUEST_METHOD'].' '.$_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL']."\r\n".'Host: '.$_SERVER['SERVER_NAME']."\r\n\r\n");
  flock($lock, LOCK_UN);
  fclose($lock);
}

if (!file_exists('bot.lock')) {
touch('bot.lock');
}
$lock = fopen('bot.lock', 'r+');
$try = 1;
$locked = false;
while (!$locked) {
$locked = flock($lock, LOCK_EX | LOCK_NB);
if (!$locked) {
closeConnection();
if ($try++ >= 30) {
exit;
}
 sleep(1);
}
}
if(!file_exists('data.json')){
 file_put_contents('data.json', '{"power":"on","adminStep":"","typing":"off","echo":"off","markread":"off","poker":"off","enemies":[],"answering":[]}');
}

class EventHandler extends \danog\MadelineProto\EventHandler
{
public function __construct($MadelineProto){
parent::__construct($MadelineProto);
}
public function onUpdateSomethingElse($update)
{
if (isset($update['_'])){
  if ($update['_'] == 'updateNewMessage'){
  onUpdateNewMessage($update);
  }
  else if ($update['_'] == 'updateNewChannelMessage'){
  onUpdateNewChannelMessage($update);
}
}
}

public function onUpdateNewChannelMessage($update)
{
 yield $this->onUpdateNewMessage($update);
}
public function onUpdateNewMessage($update){
$from_id = isset($update['message']['from_id']) ? $update['message']['from_id']:'';
  try {
 if(isset($update['message']['message'])){
 $text = $update['message']['message'];
 $msg_id = $update['message']['id'];
 $message = isset($update['message']) ? $update['message']:'';
 $MadelineProto = $this;
 $me = yield $MadelineProto->get_self();
 
 $myoj=1329659952;   //آیدی عددی ادمین که میتونه خود ربات هم باشه
 
 
 
 
 
 
 
 $admin = $myoj ; 
 $chID = yield $MadelineProto->get_info($update);
 $peer = $chID['bot_api_id'];
 $type3 = $chID['type'];
 $data = json_decode(file_get_contents("data.json"), true);
 $step = $data['adminStep'];
 if($from_id == $admin){
 if($text == '/exit;'){
  exit;
 }
   if(preg_match("/^[\/\#\!]?(bot) (on|off)$/i", $text)){
     preg_match("/^[\/\#\!]?(bot) (on|off)$/i", $text, $m);
     $data['power'] = $m[2];
     file_put_contents("data.json", json_encode($data));
     $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Bot Now Is $m[2]"]);
   }
   if(preg_match("/^[\/\#\!]?(online) (on|off)$/i", $text)){
  preg_match("/^[\/\#\!]?(online) (on|off)$/i", $text, $m);
  file_put_contents('online.txt', $m[2]);
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Online Mode Now Is $m[2]"]);
   }
     if ($text == 'ping' or $text == '/ping') {
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Hi mr.sbi :)"]);
  }
  
   if($text=='bk' or $text=='بکیرم'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '
😂😂😂
😂         😂
😂           😂
😂        😂
😂😂😂
😂         😂
😂           😂
😂           😂
😂        😂
😂😂😂']);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
😂         😂
😂       😂
😂     😂
😂   😂
😂😂
😂   😂
😂      😂
😂        😂
😂          😂
😂            😂']);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
😂😂😂          😂         😂
😂         😂      😂       😂
😂           😂    😂     😂
😂        😂       😂   😂
😂😂😂          😂😂
😂         😂      😂   😂
😂           😂    😂      😂
😂           😂    😂        😂
😂        😂       😂          😂
😂😂😂          😂            😂']);
    
}
if($text=='خمینی' or $text=='امام'){
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "

⣿⣿⣿⣿⣿⡿⠋⠁⠄⠄⠄⠈⠘⠩⢿⣿⣿⣿⣿⣿ 
⣿⣿⣿⣿⠃⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠻⣿⣿⣿⣿ 
⣿⣿⣿⣿⠄⠄⣀⣤⣤⣤⣄⡀⠄⠄⠄⠄⠙⣿⣿⣿ 
⣿⣿⣿⣿⡀⢰⣿⣿⣿⣿⣿⢿⠄⠄⠄⠄⠄⠹⢿⣿ 
⣿⣿⣿⣿⣿⡞⠻⠿⠟⠋⠉⠁⣤⡀⠄⠄⠄⠄⠄⠄ 
⣿⣿⣿⣿⣿⣿⣶⢼⣷⡤⣦⣿⠛⡰⢃⠄⠐⠄⠄⢸ 
⣿⣿⣿⣿⣿⣿⣿⡯⢍⠿⢾⡿⣸⣿⠰⠄⢀⠄⠄⡬ 
⣿⣿⣿⣿⣿⣿⣿⣴⣴⣅⣾⣿⣿⡧⠦⡶⠃⠄⠠⢴ 
⣿⣿⣿⣿⠿⠍⣿⣿⣿⣿⣿⣿⣿⢇⠟⠁⠄⠄⠄⠄ 
⠟⠛⠉⠄⠄⠄⡽⣿⣿⣿⣿⣿⣯⠏⠄⠄⠄⠄⠄⠄ 
⠄⠄⠄⢀⣾⣾⣿⣤⣯⣿⣿⡿⠃⠄⠄⠄⠄⠄⠄⠄
"]);
}

if($text=='ps5' or $text=='سونی'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '
.
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢰⣦⣄⡀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠿⣷⣦
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣧
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣿
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣿


']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
.
           ⢰⣦⣄⡀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠿⣷⣦
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣧
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣿
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣿
⠀⠀⠀⠀⠀⠀⠀⢀⣠⢸⣿⣿⠀⠻⠿⠋
⠀⠀⠀⠀⣀⣤⣶⣿⡿⢸⣿⣿⢠⣶⣾⣿⠷⣶⣤⡀
⠀⠀⠀⢾⣿⣿⠋⢁⣠⢸⣿⣿⠸⠛⢉⣠⣴⣿⣿⠇
⠀⠀⠀⠈⠙⠛⠿⠿⠟⢸⣿⣿⢠⣾⣿⡿⠟⠋
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⠻⠘⠋⠁
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
.
           ⢰⣦⣄⡀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠿⣷⣦
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣧
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣿
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣿
⠀⠀⠀⠀⠀⠀⠀⢀⣠⢸⣿⣿⠀⠻⠿⠋
⠀⠀⠀⠀⣀⣤⣶⣿⡿⢸⣿⣿⢠⣶⣾⣿⠷⣶⣤⡀
⠀⠀⠀⢾⣿⣿⠋⢁⣠⢸⣿⣿⠸⠛⢉⣠⣴⣿⣿⠇
⠀⠀⠀⠈⠙⠛⠿⠿⠟⢸⣿⣿⢠⣾⣿⡿⠟⠋
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⠻⠘⠋⠁

⣤⣤⣤⣤⣤⣤⣤⡀⠀⠀⠀⣠⣤⣤⣤⡄ ⢠⣤⣤⣤⣤⣤⣤⣤
⠀⠀⠀⠀⠀⠀⢸⡇⠀⠀⠀⣿⠀⠀⠀⠀ ⢸⡇
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
/////////
/////////  ⢰⣦⣄⡀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠿⣷⣦
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣧
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣿
⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⣿⣿⣿
⠀⠀⠀⠀⠀⠀⠀⢀⣠⢸⣿⣿⠀⠻⠿⠋
⠀⠀⠀⠀⣀⣤⣶⣿⡿⢸⣿⣿⢠⣶⣾⣿⠷⣶⣤⡀
⠀⠀⠀⢾⣿⣿⠋⢁⣠⢸⣿⣿⠸⠛⢉⣠⣴⣿⣿⠇
⠀⠀⠀⠈⠙⠛⠿⠿⠟⢸⣿⣿⢠⣾⣿⡿⠟⠋
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⠻⠘⠋⠁

⣤⣤⣤⣤⣤⣤⣤⡀⠀⠀⠀⣠⣤⣤⣤⡄ ⢠⣤⣤⣤⣤⣤⣤⣤
⠀⠀⠀⠀⠀⠀⢸⡇⠀⠀⠀⣿⠀⠀⠀⠀ ⢸⡇
⣴⠟⠛⠛⠛⠛⠋⠁⠀⠀⠀⣿⠀⠀⠀⠀ ⠘⠛⠛⠛⠛⠛⠻⣦
⣿⠀⠀⠀⠀⠀⠀⢠⣤⣤⣴⠟⠀⠀⠀⠀ ⢠⣤⣤⣤⣤⣤⣴⠟
"]);

}

if($text=='سردار' or $text=='سلیمانی'){
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "

⣿⣿⣿⣿⣿⣿⣿⣿⠿⠟⠉⠭⠙⠛⠙⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⡿⠟⠑⠙⠀⠀⠀⢀⢀⠉⠀⠀⠍⠉⠙⠻⣿⣿⣿⣿⣿⣿
⣿⣿⠏⠆⠂⠀⠀⠀⠀⠀⠀⠉⠑⠰⢂⣶⣖⠀⠀⠙⢿⣿⣿⣿⣿
⣿⡗⠀⢠⣶⣶⣾⣿⣿⣯⠀⢤⣺⣻⣥⢾⡈⠂⠀⠀⠀⣼⣿⣿⣿
⣿⡇⠀⡀⠿⠛⣿⣿⣿⣿⣾⠘⢻⣿⠃⠀⠀⠀⠀⠀⠀⠈⣿⣿⣿
⣿⣇⠀⠀⠀⠀⠀⠉⠋⠉⠙⠋⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿
⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠜⠉⣿⣿
⣿⣿⣶⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⡀⠀⠀⠀⠐⠖⣿⣿
⣿⣿⣿⣧⠀⡄⠐⠀⠀⠀⠀⠀⠀⣤⣾⣿⣿⣿⠷⠀⠀⠀⠃⣿⣿
⣿⣿⣿⣿⣧⠹⣿⣿⣿⣿⣿⠀⠈⠻⣿⡯⠟⠃⠀⠀⠀⠀⢠⣿⣿
⣿⣿⣿⣿⣿⣆⠈⠙⠇⠈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿
⣿⣿⣿⣿⣿⣿⡖⠂⠀⠀⡴⠀⠀⠀⠈⠦⡀⠀⠀⢀⣾⠀⢸⣿⣿
⣿⣿⣿⣿⣿⣿⡶⣾⠀⣰⡧⣦⣤⣴⡿⡀⢈⢷⡢⡿⠁⠀⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⢿⣿⣵⣿⠿⣿⣟⣛⣻⣿⣮⣽⣄⣾⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠞⢻⠻⠟⠛⠻⠏⠈⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣤⠀⠀⠀⠀⢀⣠⣿⣿⣿⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿
"]);
}

if($text=='پنالتی' or $text=='فوتبال'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
////////////////////
⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️





                     😐          ⚽️
                     👕 
                     👖
////////////////////
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
////////////////////
⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️




                     😐
                     👕       ⚽️
                     👖
////////////////////
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
////////////////////
⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️




                           😐
                           👕 ⚽️
                           👖
////////////////////
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
////////////////////
⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️



                                             ⚽️
                           😐
                           👕 
                           👖
////////////////////
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
////////////////////
⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️

                                                       ⚽️

                                             
                           😐
                           👕 
                           👖
////////////////////
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
////////////////////
⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⚽️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️

                                                      

                                             
                           😐
                           👕 
                           👖
////////////////////
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
////////////////////
⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⚽️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️
⬜️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬛️⬜️

                                                      

                                 💭Gooooooooolllllllll       
                           😐
                           👕 
                           👖
////////////////////
"]);
}

if($text=='کرونا بمیر' or $text=='نمکی کرونا رو بکش'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
🦠○○○○○○○🔫
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
🦠○○○○○○◄🔫
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
🦠○○○○○◄◄🔫
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
🦠○○○○◄◄◄🔫
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
🦠○○○◄◄◄◄🔫
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
🦠○○◄◄◄◄◄🔫
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
🦠○◄◄◄◄◄◄🔫
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
🦠◄◄◄◄◄◄◄🔫
"]);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
💥◄◄◄◄◄◄◄🔫
"]);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
نمکی کرونا را شکست داد🇮🇷
"]);
yield $MadelineProto->sleep(2);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
بر تبل شادانه بکوب
"]);
yield $MadelineProto->sleep(2);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
پیروز و مردانه بکوب
"]);
yield $MadelineProto->sleep(2);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
برخیز و پرچم را ببر 
"]);
yield $MadelineProto->sleep(2);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
بر سر در خانه بکوب
"]);
yield $MadelineProto->sleep(2);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "
🇮🇷🇮🇷🇮🇷🇮🇷🇮🇷🇮🇷
"]);
yield $MadelineProto->sleep(2);
}

if($text=='سوزدار بخون' or $text=='ای دوست'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
⏭▶️⏸⏮
"]);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
منم سرگشته‌ی حیرانت ای دوست
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
کنم یک باره جان قربانت ای دوست
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
تنـــی نـــاسـاز  شـوق وصـل کـویت
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
دهم سر بر سـر پیمانت ای دوست
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
دلــی دارم در آتــش خـــانه کــــرده 
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
میـــان شعـــله هـــا کـاشانه کـرده
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
دلـــی دارم که از شــــوق وصـــالـت
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
وجـــودم را ز غـــم ویـــــرانه کــرده
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
مـــن آن آواره‌ی بشــکسـته حــالـم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
ز هجـــرانت بـــتـــــا رو  بـــــر زوالـم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
منــم آن مـــرغ ســـرگــردان و تنهـا 
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
پریشــان گشته شد یکبـــاره حـالم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
سـحـر ســـر بـــر سـرسجاده کردم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
دعــــایی بهــــر آن دلـداده کـــــردم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
زحسرت ساغر چشمانم ‌ای دوست
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
لبـــالب یکســـره از بــــاده کــــردم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
دلا تــا کـــی اسیـــر یـــاد یـــــــاری
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
ز هجــــر یــــار تـــا کــی داغـــداری
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
بگــو تـــاکــی ز شــوق روی لیـــلی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
چـــو مجنـــون پـــریشــان روزگـاری
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
پـــریشـــانم پــریشـــان روزگــــــارم  
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
مــن آن ســرگشته ی هجــر نگارم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
کنــــون عمـــریست بـا امید وصـلت
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
درون سینـــه آســـــایــش نــــدارم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
ز هجـــرت روز و شـب فــریـــاد دارم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
ز بیدادت دلـــی نـــــاشــــــاد دارم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
درون کوهــســـار سیـنـه ی خــــود 
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
هـــزاران کشـــته چـون فـرهاد دارم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
چـــــرا ای نــــازنیــنم بـــی وفـــایی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
دمـــادم بــــا دل مـــن در جفــایـی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
چــــرا آشـفــته کــــردی روزگــــــارم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
عـــزیــزم دارد این دل هـــم خدایی
"]);
}


if($text=='یاس بخون' or $text=='یاس'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
⏭▶️⏸⏮
"]);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
مثالِ علفِ هرز خبرا میپیچه به دورم و
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
به گوشمم میرسه ، اینا میگن لال شدم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
آزادی بیان مُد شد همه جیگر دار شدن و
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
این ترسناک ترین روالِ خفه کردنه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
که فشارِ دستا رو حس نکنی پسِ گردنت
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
و اما تو ، یه شاکی از سره دغدغه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
که پشتِ پرده دستا قنوتی توو صفِ اوله
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
یعنی شرف داره دشمن هزار و صد مرتبه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
به این توده‌ی خوش استقبالِ بد بدرقه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
مینوشتم، تو مطمئن تر
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
از اینکه مشکل اَ ما نیست اونا مستبدن
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
آینده شُل کرد رو دوشِ صندلیا
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
در واقع خودم شدم دلیلِ تنبلیا
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
حالا بیا فرو کن توو سر که بابا فردا حالاست
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
مملکتی که هر گیر و داری حله با لاس
"]);yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
سمتِ ما به همت و ثبات این کله بالاست
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
دهنِ شمارم نمیشه بست حتی با ماسک
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
لقِ هرچی قافیه وقتی محتوا
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
رو بی محتوایی استواره گله مبتلا
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
اعم از ، پیر جوان مغزه نوجوان
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
راهِ من جدا پیِ سبکِ خود کفا
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
رای این کلمه برام تعریفِ مرزیه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
که بینمون کشیدم این تألیفِ اصلیه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
ثمره‌ی یک سال سکوت ، تووی مغزم رسم شد
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
باید از مصرف قطع به منبع وصل شد
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
و اما تو ، خوب میشناسم تو رو
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
أ تووی خودت میکشم بیرون و میندازم جلو
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
نه ورندازش کن خودت براندازش کن
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
من هیچی نگم بهتره به خودت میسپارم تو رو
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
برو بابا تو هرکی بالاست گفتی پشتش پُره
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
حیفِ دست که بخواد واسه ‌ی تو مشتش کنه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
دِ آخه نا چیز آدم باید یه حجمِ منطقی توو خودش ببینه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
که بخواد اونو خشکش کنه
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
ما رسیدیم از یه راهِ پر حادثه ‌ی پر ریسک
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
که حتی فکرشم در حد هاضمه‌ ی تو نیست
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
نتیجه این همه سال مشقت با دستِ خالی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
حالا تبدیل شده به یه جاذبه‌‌ی توریست نما
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
یا در حقیقت حروم زاده هایی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
که رو این میراث با میخ نوشتن یادگاری
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
وقتی حتی بعده بمبِ اتم سوسک نمرد
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
نخاله زنده‌‌‍ست تهِ زباله‌دانِ تاریخ
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
ظاهر و باطنی پشت و رویی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
ظاهراً گرسنه نیستی باطناً گشنه خوئی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
لافتو از پایین زدی ساکنِ پشتِ بومی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
قلمو دستِ منِ صاف بشین تو پشتِ بومی
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
اون که نردبونِ زیرتو شکوند
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
من نبودم اونه که بهت تا دینشو چپوند
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
من زیستنو نوشتم تو زیستتو بخون
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
من اگه خطر میکنم میخرم ریسکشو به جون
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
درست شد؟
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
آها ، من اومدم که نرم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
این ناگفته ها میخوان مغزمو از سرم بکَنن
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
اگه بخوام از اعتبار و شرف بگذرم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
که الآن باید نصفِ این شهرو سند بزنم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
یه دریا بنزینم در پیِ جرقه زدن
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
اینا نورِ سنو میخوان من توو مخم شمع دارم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
شب کارم ، با هر یه مصرع به خودم دَم دادم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
خب ، هنرمندا راست دولتمردا چپ
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
تف به اون صفی که بشه مرتب با چَک
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
رو ضرب عرش هر وزنو ضربه میکنم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
توو عصرِ پاچه خوارا فقط کله میخورم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
شک نمیکنم که واسم تنها سلاح باوره
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
که دشمنِ سکوت فقر ضعف الی آخره
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
من اومدم که نرم ، من اومدم که نرم
"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "
من اومدم که نرم ، من اومدم که نرم
"]);
}


if($text=='tas' or $text=='تاس'){
$tas="
+----------+
  | 012  |
  | 345  |
  | 678  |
+----------+";
$rand002=rand(1,6);
if($rand002==1){$tas=str_replace(4,"●",$tas);}
if($rand002==2){$tas=str_replace([0,8],"●",$tas);}
if($rand002==3){$tas=str_replace([0,4,8],"●",$tas);}
if($rand002==4){$tas=str_replace([0,2,6,8],"●",$tas);}
if($rand002==5){$tas=str_replace([0,2,6,8,4],"●",$tas);}
if($rand002==6){$tas=str_replace([0,2,6,8,3,5],"●",$tas);}

$tas=str_replace(range(0,8),'   ',$tas);

$ed = $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id, 'message' =>$tas, 'parse_mode' => 'html' ]);
}


if($text=='سفید کون' or $text=='کون سفید'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "کون"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "کون سفید"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "کون سفید من"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "کون سفید من چطورع"]);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => "یع دس مرامی دارکوبی بزن❤️"]);
yield $MadelineProto->sleep(1);
}
if($text=='کیحر' or $text=='کیر'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟪🟧🟧🟧
🟪🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟪🟪🟧🟧
🟪🟪🟧🟧🟧
🟪🟧🟧🟧🟧
🟧🟧🟧🟧🟧
🟧🟧🟧🟧🟧
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟪🟪🟪🟧
🟪🟪🟪🟧🟧
🟪🟪🟧🟧🟧
🟪🟧🟧🟧🟧
🟧🟧🟧🟧🟧
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟧
🟪🟪🖕🟧🟧
🟪🟪🟧🟧🟧
🟪🟧🟧🟧🟧
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟧
🟪🟪🟪🟧🟧
🟪🟪🟧🟧🟧
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟧
🟪🟪🟪🟧🟧
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟧
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟦🟪🟪🟪
🟦🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟦🟦🟪🟪
🟦🟦🟪🟪🟪
🟦🟪🟪🟪🟪
🟪🟪🟪🟪🟪
🟪🟪🟪🟪🟪
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟦🟦🟦🟪
🟦🟦🟦🟪🟪
🟦🟦🟪🟪🟪
🟦🟪🟪🟪🟪
🟪🟪🟪🟪🟪
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟪
🟦🟦🖕🟪🟪
🟦🟦🟪🟪🟪
🟦🟪🟪🟪🟪
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟪
🟦🟦🟦🟪🟪
🟦🟦🟪🟪🟪
']);


yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟪
🟦🟦🟦🟪🟪
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟪
']);


yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
🟦🟦🟦🟦🟦
']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🖕🖕🏿🖕🖕🏿🖕
']);
yield $MadelineProto->sleep(1);
yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🖕🏿🖕🖕🏿🖕🖕🏿
']);
yield $MadelineProto->sleep(1);
}


if($text=='الو تیمارستان' or $text=='روانی'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '🚶🏿‍♀________________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀_______________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀______________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀_____________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀____________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀___________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀__________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀_________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀________🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀_______🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀______🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀____🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀___🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀__🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏿‍♀_🚑']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'قان قان گرفتیمش خودع کزخلشع😐🚶‍♂️']);
}


if($text=='ماشین' or $text=='car'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '🚧________________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_______________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧______________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_____________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧____________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧___________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧__________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_______🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧______🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧____🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧___🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧__🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💥BOOM💥']);
}


if($text=='موتور' or $text=='motor'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '🚧________________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_______________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧______________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_____________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧____________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧___________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧__________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧________🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_______🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧______🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧____🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧___🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧__🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚧_🏍']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💥BOOM💥']);
}


if($text=='گوه بخور پسر' or $text=='گوه نخور پسر'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '💩________________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩_______________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩______________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩_____________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩️____________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩___________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩__________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩_________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩________🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩️_______🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩______🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩____🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩___🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩️__🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩_🚶‍♂️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩نوش جان💩']);
}

if($text=='گوه بخور دختر' or $text=='گوه نخور دختر'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '💩________________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩_______________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩______________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩_____________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩️____________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩___________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩__________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩_________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩________🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩️_______🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩______🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩____🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩___🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩️__🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩_🚶‍♀️']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💩نوش جان💩']);
}


if($text=='shot' or $text=='شات'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '1️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +2, 'message' => '2️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +3, 'message' => '3️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +4, 'message' => '4️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +5, 'message' => '5️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +6, 'message' => '6️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +7, 'message' => '7️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +8, 'message' => '8️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +9, 'message' => '9️⃣','parse_mode' => 'MarkDown']);

yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id +10, 'message' => '🔟','parse_mode' => 'MarkDown']);
$MadelineProto->messages->sendMessage(['peer' =>$peer, 'id' =>
$msg_id +11,'message' =>' پخخخ بای بای فرزندم شات شدی ','parse_mode' => 'MarkDown']);

$Updates = $MadelineProto->messages->sendScreenshotNotification(['peer' => $Peer, 'id' => $msg_id, ]);

}


if($text == 'اسکرین'  or $text== 'sh'){
$MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' => $msg_id, 'message' =>' 1⃣️ ', 'parse_mode' => 'MarkDown' ]);
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +1,'message' =>' 2⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +2,'message' =>' 3⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +3,'message' =>' 4⃣','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +4,'message' =>'5⃣  ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +5,'message' =>'6⃣  ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +6,'message' =>' 7⃣','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +7,'message' =>' 8⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +8,'message' =>' 9⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +9,'message' =>' 1⃣0⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $Peer, 'id' =>
 $msg_id +10,'message' =>' پخخخ بای بای فرزندم شات شدی ','parse_mode' => 'MarkDown']);
$Updates = $MadelineProto->messages->sendScreenshotNotification(['peer' => $Peer, 'id' => $msg_id, ]); 
}

	if ($text == 'time' or $text=='ساعت'  or $text=='تایم') {
	    date_default_timezone_set('Asia/Tehran');
	yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => ';)']);
	for ($i=1; $i <= 1000000000000000000; $i++){
	yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => date('H:i:s')]);
	yield $MadelineProto->sleep(1);
	}
	}
  
 if(preg_match("/^[\/\#\!]?(setanswer) (.*)$/i", $text)){
$ip = trim(str_replace("/setanswer ","",$text));
$ip = explode("|",$ip."|||||");
$txxt = trim($ip[0]);
$answeer = trim($ip[1]);
if(!isset($data['answering'][$txxt])){
$data['answering'][$txxt] = $answeer;
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "کلمه جدید به لیست پاسخ شما اضافه شد👌🏻"]);
}else{
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "این کلمه از قبل موجود است :/"]);
 }
}



if(preg_match("/^[\/\#\!]?(php) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(php) (.*)$/i", $text, $a);
if(strpos($a[2], '$MadelineProto') === false and strpos($a[2], '$this') === false){
$OutPut = eval("$a[2]");
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "`🔻 $OutPut`", 'parse_mode'=>'markdown']);
}
}

if(preg_match("/^[\/\#\!]?(upload) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(upload) (.*)$/i", $text, $a);
$oldtime = time();
$link = $a[2];
$ch = curl_init($link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_NOBODY, TRUE);
$data = curl_exec($ch);
$size1 = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD); curl_close($ch);
$size = round($size1/1024/1024,1);
if($size <= 200.9){
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => '🌵 Please Wait...
💡 FileSize : '.$size.'MB']);
$path = parse_url($link, PHP_URL_PATH);
$filename = basename($path);
copy($link, "files/$filename");
yield $MadelineProto->messages->sendMedia([
 'peer' => $peer,
 'media' => [
 '_' => 'inputMediaUploadedDocument',
 'file' => "files/$filename",
 'attributes' => [['_' => 'documentAttributeFilename',
 'file_name' => "$filename"]]],
 'message' => "🔖 Name : $filename
💠 [Your File !]($link)
💡 Size : @t000c ".$size.'MB',
 'parse_mode' => 'Markdown'
]);

$t=time()-$oldtime;
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "✅ Uploaded ($t".'s)']);
unlink("files/$filename");
} else {
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => '⚠️ خطا : حجم فایل بیشتر از 200 مگ است!']);
}
}
 if(preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text, $text);
$txxt = $text[2];
if(isset($data['answering'][$txxt])){
unset($data['answering'][$txxt]);
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "کلمه مورد نظر از لیست پاسخ حذف شد👌🏻"]);
}else{
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "این کلمه در لیست پاسخ وجود ندارد :/"]);
 }
}



if($text == '/id' or $text == 'id'){
  if (isset($message['reply_to_msg_id'])) {
   if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
//  $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => 'YourID : '.$messag, 'parse_mode' => 'markdown']);
} else {
	if($type3 == 'user'){
 $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "YourID : `$peer`", 'parse_mode' => 'markdown']);
}}} else {
  $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "GroupID : `$peer`", 'parse_mode' => 'markdown']);
}
}

if(isset($message['reply_to_msg_id'])){
if($text == 'unblock' or $text == '/unblock' or $text == '!unblock'){
if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
  yield $MadelineProto->contacts->unblock(['id' => $messag]);
  $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "UnBlocked!"]);
  } else {
  	if($type3 == 'user'){
yield $MadelineProto->contacts->unblock(['id' => $peer]); $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "UnBlocked!"]);
}
}
}

if($text == 'block' or $text == '/block' or $text == '!block'){
if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
  yield $MadelineProto->contacts->block(['id' => $messag]);
  $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Blocked!"]);
  } else {
 	if($type3 == 'user'){
yield $MadelineProto->contacts->block(['id' => $peer]); $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Blocked!"]);
}
}
}

if(preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text)){
$gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gmsg['messages'][0]['from_id'];
  if(!in_array($messag, $data['enemies'])){
    $data['enemies'][] = $messag;
    file_put_contents("data.json", json_encode($data));
    yield $MadelineProto->contacts->block(['id' => $messag]);
    $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "$messag is now in enemy list"]);
  } else {
    $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This User Was In EnemyList"]);
  }
}
if(preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text)){
$gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gmsg['messages'][0]['from_id'];
  if(in_array($messag, $data['enemies'])){
    $k = array_search($messag, $data['enemies']);
    unset($data['enemies'][$k]);
    file_put_contents("data.json", json_encode($data));
    yield $MadelineProto->contacts->unblock(['id' => $messag]);
    $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "$messag deleted from enemy list"]);
  } else{
    $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This User Wasn't In EnemyList"]);
  }
 }
}

if(preg_match("/^[\/\#\!]?(answerlist)$/i", $text)){
if(count($data['answering']) > 0){
$txxxt = "لیست پاسخ ها :
";
$counter = 1;
foreach($data['answering'] as $k => $ans){
$txxxt .= "$counter: $k => $ans \n";
$counter++;
}
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txxxt]);
}else{
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "پاسخی وجود ندارد!"]);
  }
 }
 if($text == 'help' or $text == 'راهنما'){
$mem_using = round(memory_get_usage() / 1024 / 1024,1);
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "راهنمای سلف بات میدلاین
`/bot ` [on] or [off]
• خاموش و روشن کردن ربات

`ping`
• دریافت وضعیت ربات

`online ` on یا off
• روشن و خاموش کردن حالت همیشه انلاین

`typing ` on یا off
• روشن و خاموش کردن حالت تایپینگ بعد از هر پیام

`markread ` on یا off
• روشن و خاموش کردن حالت خوانده شدن پیام ها

`flood ` [NUMBER] [TEXT]
•  اسپم پیام در یک متن

`flood2 ` [NUMBER] [TEXT]
•  اسپم بصورت پیام های مکرر

`contacts ` on یا off
• فعال شدن حالت ادد شدن مخاطبین به صورت خودکار

`adduser ` [UserID] [IDGroup]
• ادد کردن یه کاربر به گروه موردنظر

`setusername ` [text]
• تنظیم نام کاربری (آیدی) ربات

`profile ` [NAME] `|` [LAST] `|` [BIO]
• تنظیم نام اسم , فامیل و بیوگرافی ربات

`/blue ` [TEXT-EN]
• تبدیل متن انگلیسی به فنت Blue

`/sticker ` [TEXT]
• تبدیل متن به استیکر

`/upload ` [URL]
• اپلود فایل از لینک

`/weather ` [TEXT-EN]
• آب و هوای منطقه

`/music ` [TEXT]
• موزیک درخواستی

`block ` [@username] یا [reply]
• بلاک کردن شخصی خاص در ربات

`unblock ` [@username] یا [reply]
• آزاد کردن شخصی خاص از بلاک در ربات

`/info ` [@username]
• دریافت اطلاعات کاربر

`/gpinfo`
• دریافت اطلاعات گروه

`/sessions`
• دریافت بازنشست های فعال اکانت

`/save ` [REPLAY]
• سیو کردن پیام و محتوا  در پیوی خود ربات

`/id ` [reply]
• دریافت ایدی عددی کابر

`!setenemy ` [userid] یا [reply]
• تنظیم دشمن با استفاده از ایدی عددی یا ریپلی

`!delenemy ` [userid] یا [reply]
• حذف دشمن با استفاده از ایدی عددی یا ریپلی

`!clean enemylist`
• پاک کردن لیست دشمنان

× × × × × ×

`/setanswer ` [TEXT] | [ANSWER]
• افزودن جواب سریع (متن اول متن دریافتی از کاربر و ددوم جوابی که ربات بدهد)

`/delanswer ` [TEXT]
• حذف جواب سریع

`/clean answers`
• حذف همه جواب سریع ها

`/answerlist`
• لیست همه جواب سریع ها

× × × × × × × × × ×
🔆سرگرمی ها
⭕️موتور
⭕️ماشین
⭕️الو تیمارستان
⭕️کون سفید
⭕️بکیرم(bk)
⭕️ای دوست(اهنگ)
⭕️یاس بخون(اهنگ)
⭕️امام
⭕️سردار
⭕️سونی(ps5)
⭕️پنالتی
⭕️کرونا بمیر
⭕️تاس
⭕️کیر(کیحر)
⭕️گوه بخور پسر
⭕️گوه بخور دختر
⭕️شات یا اسکرین(shot)
⭕️ساعت(time)
///////////////////
امیدوارم لذت ببرین
× × × × × × × × × × 
@sbi_pv
♻️ مقدار رم درحال استفاده : $mem_using مگابایت",
'parse_mode' => 'markdown']);
}
if(preg_match("/^[\/\#\!]?(save)$/i", $text) && isset($message['reply_to_msg_id'])){
$me = yield $MadelineProto->get_self();
$me_id = $me['id'];
yield $MadelineProto->messages->forwardMessages(['from_peer' => $peer, 'to_peer' => $me_id, 'id' => [$message['reply_to_msg_id']]]);
      $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "> Saved :D"]);
     }
 if(preg_match("/^[\/\#\!]?(typing) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(typing) (on|off)$/i", $text, $m);
$data['typing'] = $m[2];
file_put_contents("data.json", json_encode($data));
      $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Typing Now Is $m[2]"]);
     }
    
     if(preg_match("/^[\/\#\!]?(poker) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(poker) (on|off)$/i", $text, $m);
 $data['poker'] = $m[2];
file_put_contents("data.json", json_encode($data));
$m = $MadelineProto->messages->sendMessage(['peer' => $peer, 'id' => $msg_id,'message' => "poker is 😐✅ $m[2] ",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
    
 if(preg_match("/^[\/\#\!]?(echo) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(echo) (on|off)$/i", $text, $m);
$data['echo'] = $m[2];
file_put_contents("data.json", json_encode($data));
      $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Echo Now Is $m[2]"]);
     }
 if(preg_match("/^[\/\#\!]?(markread) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(markread) (on|off)$/i", $text, $m);
$data['markread'] = $m[2];
file_put_contents("data.json", json_encode($data));
      $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Markread Now Is $m[2]"]);
     }
 if(preg_match("/^[\/\#\!]?(info) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(info) (.*)$/i", $text, $m);
$mee = yield $MadelineProto->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_status = $me['status']['_'];
$me_bio = $mee['full']['about'];
$me_common = $mee['full']['common_chats_count'];
$me_name = $me['first_name'];
$me_uname = $me['username'];
$mes = "ID: $me_id \nName: $me_name \nUsername: @$me_uname \nStatus: $me_status \nBio: $me_bio \nCommon Groups Count: $me_common";
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => $mes]);
     }
 if(preg_match("/^[\/\#\!]?(block) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(block) (.*)$/i", $text, $m);
yield $MadelineProto->contacts->block(['id' => $m[2]]);
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Blocked!"]);
     }
 if(preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $text, $m);
yield $MadelineProto->contacts->unblock(['id' => $m[2]]);
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "UnBlocked!"]);
     }
 if(preg_match("/^[\/\#\!]?(checkusername) (@.*)$/i", $text)){
preg_match("/^[\/\#\!]?(checkusername) (@.*)$/i", $text, $m);
$check = yield $MadelineProto->account->checkUsername(['username' => str_replace("@", "", $m[2])]);
if($check == false){
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Exists!"]);
} else{
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Free!"]);
}
     }
 if(preg_match("/^[\/\#\!]?(setfirstname) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setfirstname) (.*)$/i", $text, $m);
yield $MadelineProto->account->updateProfile(['first_name' => $m[2]]);
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Done!"]);
     }
 if(preg_match("/^[\/\#\!]?(setlastname) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setlastname) (.*)$/i", $text, $m);
yield $MadelineProto->account->updateProfile(['last_name' => $m[2]]);
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Done!"]);
     }

 if(preg_match("/^[\/\#\!]?(setbio) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setbio) (.*)$/i", $text, $m);
yield $MadelineProto->account->updateProfile(['about' => $m[2]]);
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Done!"]);
     }
 if(preg_match("/^[\/\#\!]?(setusername) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setusername) (.*)$/i", $text, $m);
yield $MadelineProto->account->updateUsername(['username' => $m[2]]);
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Done!"]);
     }
 if(preg_match("/^[\/\#\!]?(join) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(join) (.*)$/i", $text, $m);
yield $MadelineProto->channels->joinChannel(['channel' => $m[2]]);
$MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Joined!"]);
     }
if(preg_match("/^[\/\#\!]?(add2all) (@.*)$/i", $text)){
preg_match("/^[\/\#\!]?(add2all) (@.*)$/i", $text, $m);
$dialogs = yield $MadelineProto->get_dialogs();
foreach ($dialogs as $peeer) {
$peer_info = yield $MadelineProto->get_info($peeer);
$peer_type = $peer_info['type'];
if($peer_type == "supergroup"){
  yield $MadelineProto->channels->inviteToChannel(['channel' => $peeer, 'users' => [$m[2]]]);
}
}
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "Added To All SuperGroups"]);
     }
 if(preg_match("/^[\/\#\!]?(newanswer) (.*) \|\|\| (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(newanswer) (.*) \|\|\| (.*)$/i", $text, $m);
$txxt = $m[2];
$answeer = $m[3];
if(!isset($data['answering'][$txxt])){
$data['answering'][$txxt] = $answeer;
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "New Word Added To AnswerList"]);
} else{
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This Word Was In AnswerList"]);
}
     }
 if(preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text, $m);
$txxt = $m[2];
if(isset($data['answering'][$txxt])){
unset($data['answering'][$txxt]);
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "Word Deleted From AnswerList"]);
} else{
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This Word Wasn't In AnswerList"]);
}
     }
 if(preg_match("/^[\/\#\!]?(clean answers)$/i", $text)){
$data['answering'] = [];
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "AnswerList Is Now Empty!"]);
     }
 if(preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text, $m);
$mee = yield $MadelineProto->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_name = $me['first_name'];
if(!in_array($me_id, $data['enemies'])){
$data['enemies'][] = $me_id;
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->contacts->block(['id' => $m[2]]);
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "$me_name is now in enemy list"]);
} else {
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This User Was In EnemyList"]);
}
     }
 if(preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text, $m);
$mee = yield $MadelineProto->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_name = $me['first_name'];
if(in_array($me_id, $data['enemies'])){
$k = array_search($me_id, $data['enemies']);
unset($data['enemies'][$k]);
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->contacts->unblock(['id' => $m[2]]);
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "$me_name deleted from enemy list"]);
} else{
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This User Wasn't In EnemyList"]);
}
     }
 if(preg_match("/^[\/\#\!]?(clean enemylist)$/i", $text)){
$data['enemies'] = [];
file_put_contents("data.json", json_encode($data));
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "EnemyList Is Now Empty!"]);
     }
 if(preg_match("/^[\/\#\!]?(enemylist)$/i", $text)){
if(count($data['enemies']) > 0){
$txxxt = "EnemyList:
";
$counter = 1;
foreach($data['enemies'] as $ene){
  $mee = yield $MadelineProto->get_full_info($ene);
  $me = $mee['User'];
  $me_name = $me['first_name'];
  $txxxt .= "$counter: $me_name \n";
  $counter++;
}
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txxxt]);
} else{
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "No Enemy!"]);
}
     }
 if(preg_match("/^[\/\#\!]?(inv) (@.*)$/i", $text) && $update['_'] == "updateNewChannelMessage"){
preg_match("/^[\/\#\!]?(inv) (@.*)$/i", $text, $m);
$peer_info = yield $MadelineProto->get_info($message['to_id']);
$peer_type = $peer_info['type'];
if($peer_type == "supergroup"){
yield $MadelineProto->channels->inviteToChannel(['channel' => $message['to_id'], 'users' => [$m[2]]]);
} else{
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "Just SuperGroups"]);
}
     }
 if(preg_match("/^[\/\#\!]?(leave)$/i", $text)){
yield $MadelineProto->channels->leaveChannel(['channel' => $message['to_id']]);
     }
 if(preg_match("/^[\/\#\!]?(flood) ([0-9]+) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(flood) ([0-9]+) (.*)$/i", $text, $m);
$count = $m[2];
$txt = $m[3];
$spm = "";
for($i=1; $i <= $count; $i++){
$spm .= "$txt \n";
}
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $spm]);
     }
 if(preg_match("/^[\/\#\!]?(flood2) ([0-9]+) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(flood2) ([0-9]+) (.*)$/i", $text, $m);
$count = $m[2];
$txt = $m[3];
for($i=1; $i <= $count; $i++){
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt]);
}
     }
 if(preg_match("/^[\/\#\!]?(music) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(music) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@melobot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(wiki) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(wiki) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@wiki", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(youtube) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(youtube) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@uVidBot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(pic) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(pic) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@pic", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(gif) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(gif) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@gif", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(google) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(google) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@GoogleDEBot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(joke)$/i", $text)){
preg_match("/^[\/\#\!]?(joke)$/i", $text, $m);
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@function_robot", 'peer' => $peer, 'query' => '', 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(aasab)$/i", $text)){
preg_match("/^[\/\#\!]?(aasab)$/i", $text, $m);
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@function_robot", 'peer' => $peer, 'query' => '', 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][1]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(like) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(like) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@like", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(search) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(search) (.*)$/i", $text, $m);
$q = $m[2];
$res_search = yield $MadelineProto->messages->search(['peer' => $peer, 'q' => $q, 'filter' => ['_' => 'inputMessagesFilterEmpty'], 'min_date' => 0, 'max_date' => time(), 'offset_id' => 0, 'add_offset' => 0, 'limit' => 50, 'max_id' => $message['id'], 'min_id' => 1]);
$texts_count = count($res_search['messages']);
$users_count = count($res_search['users']);
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "Msgs Found: $texts_count \nFrom Users Count: $users_count"]);
foreach($res_search['messages'] as $text){
$textid = $text['id'];
yield $MadelineProto->messages->forwardMessages(['from_peer' => $text, 'to_peer' => $peer, 'id' => [$textid]]);
 }
}

if(strpos($text,"del")!==false){
if(!isset($update['update']['message']['reply_to_msg_id'])){
$del = str_replace("clean","",$text);
if(is_numeric($del)){
for($i = $msg_id -1; $i>=$msg_id -1-$del;$i--){
$MadelineProto->messages->deleteMessages(['peer' => $peer, 'id' => [$i]]);
}
$ed = $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id, 'message' =>"$del Nember deleted ✅ \n
By => [$userID](tg://user?id=$userID)️
 ", 'parse_mode' => 'MarkDown' ]);
}else{
$ed = $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id, 'message' =>"ERROR ❌ use number for delete \n
MR. »» [$userID](tg://user?id=$userID)️ 
", 'parse_mode' => 'MarkDown' ]);
}
}
}

 else if(preg_match("/^[\/\#\!]?(weather) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(weather) (.*)$/i", $text, $m);
$query = $m[2];
$url = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$query."&appid=eedbc05ba060c787ab0614cad1f2e12b&units=metric"), true);
$city = $url["name"];
$deg = $url["main"]["temp"];
$type1 = $url["weather"][0]["main"];
if($type1 == "Clear"){
		$tpp = 'آفتابی☀';
		file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Clouds"){
		$tpp = 'ابری ☁☁';
		file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Rain"){
		 $tpp = 'بارانی ☔';
file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Thunderstorm"){
		$tpp = 'طوفانی ☔☔☔☔';
file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Mist"){
		$tpp = 'مه 💨';
file_put_contents('type.txt',$tpp);
	}
  if($city != ''){
$eagle_tm = file_get_contents('type.txt');
  $txt = "دمای شهر $city هم اکنون $deg درجه سانتی گراد می باشد

شرایط فعلی آب و هوا: $eagle_tm";
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt]);
unlink('type.txt');
}else{
 $txt = "⚠️شهر مورد نظر شما يافت نشد";
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt]);
 }
}
  else if(preg_match("/^[\/\#\!]?(sessions)$/i", $text)){
$authorizations = yield $MadelineProto->account->getAuthorizations();
$txxt="";
foreach($authorizations['authorizations'] as $authorization){
$txxt .="
هش: ".$authorization['hash']."
مدل دستگاه: ".$authorization['device_model']."
سیستم عامل: ".$authorization['platform']."
ورژن سیستم: ".$authorization['system_version']."
api_id: ".$authorization['api_id']."
app_name: ".$authorization['app_name']."
نسخه برنامه: ".$authorization['app_version']."
تاریخ ایجاد: ".date("Y-m-d H:i:s",$authorization['date_active'])."
تاریخ فعال: ".date("Y-m-d H:i:s",$authorization['date_active'])."
آی‌پی: ".$authorization['ip']."
کشور: ".$authorization['country']."
منطقه: ".$authorization['region']."

====================";
}
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txxt]);
     }
 if(preg_match("/^[\/\#\!]?(gpinfo)$/i", $text)){
$peer_inf = yield $MadelineProto->get_full_info($message['to_id']);
$peer_info = $peer_inf['Chat'];
$peer_id = $peer_info['id'];
$peer_title = $peer_info['title'];
$peer_type = $peer_inf['type'];
$peer_count = $peer_inf['full']['participants_count'];
$des = $peer_inf['full']['about'];
$mes = "ID: $peer_id \nTitle: $peer_title \nType: $peer_type \nMembers Count: $peer_count \nBio: $des";
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $mes]);
     }
   }
 if($data['power'] == "on"){
   if ($from_id != $admin) {
   if($message && $data['typing'] == "on" && $update['_'] == "updateNewChannelMessage"){

         $sendMessageGamePlayAction = ['_' => 'sendMessageGamePlayAction'];
         $sendMessageRecordVideoAction = ['_' => 'sendMessageRecordVideoAction'];
		 $sendMessageRecordAudioAction = ['_' => 'sendMessageRecordAudioAction'];
		 $sendMessageRecordRoundAction = ['_' => 'sendMessageRecordRoundAction'];
		 $sendMessageUploadVideoAction = ['_' => 'sendMessageUploadVideoAction'];
	     $sendMessageUploadAudioAction = ['_' => 'sendMessageUploadAudioAction'];
	     $sendMessageUploadPhotoAction = ['_' => 'sendMessageUploadPhotoAction'];
	     $sendMessageUploadDocumentAction = ['_' => 'sendMessageUploadDocumentAction'];
	     $sendMessageUploadRoundAction = ['_' => 'sendMessageUploadRoundAction'];
	     $sendMessageGeoLocationAction = ['_' => 'sendMessageGeoLocationAction'];
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageGamePlayAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageRecordVideoAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageRecordAudioAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageRecordRoundAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageUploadVideoAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageUploadAudioAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageUploadPhotoAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageUploadDocumentAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageUploadRoundAction]);
yield $MadelineProto->sleep(5);
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageGeoLocationAction]);
yield $MadelineProto->sleep(5);
     }
     if($message && $data['echo'] == "on"){
yield $MadelineProto->messages->forwardMessages(['from_peer' => $peer, 'to_peer' => $peer, 'id' => [$message['id']]]);
     }
     if($message && $data['markread'] == "on"){
if(intval($peer) < 0){
yield $MadelineProto->channels->readHistory(['channel' => $peer, 'max_id' => $message['id']]);
yield $MadelineProto->channels->readMessageContents(['channel' => $peer, 'id' => [$message['id']] ]);
} else{
yield $MadelineProto->messages->readHistory(['peer' => $peer, 'max_id' => $message['id']]);
}
     }
     if(strpos($text, '😐') !== false and $data['poker'] == "on"){
$MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '😐', 'reply_to_msg_id' => $message['id']]);
     }
  $fohsh = [
  
"کس ناموس خر ناموست گاییدم بیناموس",

"کیر تو قومت قوم سکسی لش ناموس",

"کسس قوم خری جن کس ناموس",

"کیر تو قوم خرابت بیناموس خراب خواهر",

"کیر تو خواهر لشت بیناموس گوز مادر",

"قوم کسس قطاری تخمی کس مادر",

"قوم کس گوز ناموس کس شقی",

"خواهر کسس جاگوزی ناموس عن",

"خواهر کس چلاغ بیناموس خواهر جن",

"خواهر کسس جن خراب ناجوس",

"کس اقوام خر کس جد خرسی",

"کیر تو خواهر اوبیت بیناموس",

"خواهر کسس پکی ناموسس عن",

"خواهر کس لش جد کس ول",

"جد قوم کس لش ناموس",

"جد قوم عنی بیناموس لشی",

"ناموس کس فلزی مادر گواد",

"قوم کسس بمبی بیناموس",

"قوم کس جرقه ناموس کس هرزه",

"قوم کس پکی کیر بناموست مادر کس",

"قوم کس ویروسی بیناموس مادر",

"قوم کس کرونایی بیناموس جهشی خواهر",

"خواهر کس سرطانی بیناموس",

"خواهر کس ایدزی لش کس ناموس",

"خواهر کس بنگی کیر تو خواهرت",

"خواهر کسس لجنی خواهرت میگایم",

"خواهر کسس پکی ناموست میکنم",

"خواهر کس چرتی ناجوست بکیرم",

"خواهر کس پوز دراز ناموست بتخمم",

"اجداد کس خراب ناموست به جاده میزارم",

"اجداد کسس ول ناپوست بکیر جن میزارم",

"اجداد کس تخمی مادر قهبه",

"اجداد کس ریلی تخمی ناموس"
,
"اجداد کسس ایموجی ناموست میکنم"
,
"اجداد کس مبایلی"
,
"اجداد کسس پنکه ای"
,
"اجداد کس تلفزیونی"
,
"خواهر کسس مبایلی"
,
"خواهر کسس طلایی ناموس"
,
"خواهر کسس قرمزی"
,
"خواهر کسس فلفلی ناموست میکنم"
,
"خواهر کس جاگوزی میکنم قومتو"
,
"خواهر کس ماشینی خواهرت بکیرم بالا باش"
,
"خواهر کس سیمی ناموس جن"
,
"مادر کس ول خراب"
,

"مادر کس پشمی لش قوم"
,

"مادر کسس تختی خواهر کون لش"
,

"خواهر کون باز"

,
"خواهر کون خرسی"

,
"خواهر کون سسی"
,

"خواهر کس پنجره ای"
,

"خواهر کس جرقه ای کجایی بیناموس"
,

"خواهر کسس بمب اتمی"
,

"بمب اتم تو کس خواهرت"

,
"قطار تو کسس خواهرت"

,
"موشک تو کسس ناموست"

,
"ریل قطار تو کس اجدادت"

,
"مورچه تو کسس مردهات"

,
"مورچه تو کسس خواهر کوچیکت"

,
"خرس تو کسس قومت"
,

"خرس تو کون دختر کوچیکا قومت"
,

"کیر خرس تو کس ناموس قومت"
,

"کیر جن تو ناموس اجدادت"
,

"کیر شیطون تو کس خواهر کوچیکت"
,

"شیشه نوشابه تو کون مادرت"
,

"شیشه دلستر تو کسس خواهرت میزارم"
,

"چراغ تو کون خواهرت"
,

"چتر نجات تو کسس قومت"
,

"پلاستیک تو کسس مادرت"
,

"اب کیر شیطون تو کس ناموست"

,
"میمون تو کسس خواهرت"
,

"خواهرت بکیر میمون"
,

"ناجوس کس جری بیناموس"
,

"ناموس کس تام جری بیناموس پا بزن"

,
"مادر کسس هرزه"

,
"هرزه کس مادر ول ناموس"
,

"مادر کسس موتوری"
,

"گاز تو کسس مادرت"
,

"کیرم تو لباس خواب خواهرت"
,

"کیرم تو درز خواهر کوچیکت"
,

"کیرم تو درز کس خواهر بزرگت"
,

"کیرم تو شکمه مادرت"
,

"کیرم تو کله ناموست"
,

"کیرم تو زیر بقل مادرت"
,

"کیرم تو موها مادرت"
,

"کیر بابات تو کس خواهرت"
,
"کس خواهرت بکیر داداشت"
,

"کس اقوامت بکیر گربه"
,

"کس اقوامت تو اگزوز ماشین"
,

"اگزوز ماشین تو کس ناموست"
,

"گاری تو کسس مردهات"

,
"بیل تو کسس مادرت"

,
"کیر فیل تو کس اقوامت"
,

"اقوامت بکیر خرس"
,

"اقوام ناموس کس لجنی"
,

"لجنی ناموس کس اقوام"
,

"بازی پلی تو کسس ناموست"

,
"دسه پلستیشن تو کس خواهرت"
,

"کیرم تو ممه خواهرت"
,

"اب کیرم تو ممه خوواهرت"
,
"اب کیررم تو کون خواهر بزرگت"
,
"اب کیرم تو چشه خواهرت"
,
"لباس زیر خواهرت بکیرم"
,
"کیر تو جا نمازی مادزت"
,
"کیر تو جا خواب مادرت"
,
"کیر بابام تو ناموست بره"
,
"کیر به هرچی دختر کوچیک تو قومت"
,
"قوم کس فلاکسی ناموست میکنم"
,
"ناموس کس هزارپا"
,
"ناموس کس دریایی"
,
"ناموس کسس بشکه ای ناموست میکنم"
,
"ناموس کس پلنگیی"
,
"خواهر کس بشکه ای"
,
"خواهر کس باز بیناموس"
,
"خواهر کس تانکر بی پدر مادر"
,
"خواهر کسس چرتی بی ناموس"
,
"میشاشم تو کس خواهرت"
,
"پرستو تو کس ناموست"
,

"موتور دیزل تو کس قومت"
,
"پستون ماشین تو کس مردهات"
,
"اردک تو کس قومت"
,
"ماهی تو کس خواهرت"
,
"درخت تو کس خواهرت"
,
"شاش تو دهن مادرت"
,
"مادر کس کفتار بیناموس"
,
"مادر کس خلالی دی جنده"
,
"دده کسس لش"
,
"دده کس خلی بیناموس"
,
"دده کس مورچه ای خواهر چسی"
,
"دده کس پشمکی بیناموسی"
,
"دده کسس پلاکی"
,
"دده کس ماشینی"
,
"دده کس پاکتی"
,
"قوم کس کانتینر"
,
"قوم کس فلاتی"
,
"قوم کسس سه چرخه"
,
"قوم کس دوچرخه ای"
,
"خواهرکسس بتری"
,
"خواهر کس قایق"
,
"بیناموس چرا برا بابات شاخ میشی ناموست میکنم مادر کسو"
,
"مادر کس اسبی خواهرت میکنم"
,
"مادر کس مرغی ناموست میزارم بکیرم"
,
"خواهر کسس زنبور قومتو میگائم"
,
"خواهر کس پروانه بیناموس"
,
"خواهر کسس عقرب بی پدر مادر"
,
"خواهر کسس هزارپا جد ول"
,
"خواهر کسس مار جدت میکنم"
,
"دده کسس پشمی ناموست میزارم بتخمم"
,
"خواهر کسس شرتی"
,
"خواهر کسس سیگاری"
,
"ناموس کسس کرگدن"
,
"ناموسس کسس خرگوش"
,
"ناموس کسس درخت کاج"
,
"قوم کس مستراب"
,
"قوم کس تراکتری"
,
"تراکتور تو کسس قومت"
,
"اجیل تو کس مردهات"
,
"تخت بیمارستان تو کس قومت"
,
"کیر هرچی دکتر تو کس ناموست"
,
"هرچی ساختمانه تو کسس مردهات"
,
"کره زمین تو کس خواهر کچلوت"
,
"اب دریا تو کسس مادرت"
,
"دوچرخه تو کسس مردهات"
,
"هواپیما تو کسس قومت"
,
"چرخ فلک تو کسس ناموست"
,
"کوه تو کسس نوامیست"
,
"اتش فشان تو کون قومت"
,
"جرثقیل تو کون مادرت"
,
"اسباب بازی تو کون خواهرت"
,
"پاستیل تو کسس قومت"
,
"سوسک تو کسس خواهرت"
,
"عقربه ساعت تو کس قومت"
,
"ساعت تو کسس خواهرت"
,
"تلفن تو کوون قومت"
,
"رادیون تو کسس جدت"
,
"چراغ قوه تو کون جدت"
,
"دوشاخ تو کون مردهات"
,
"باتری تو کون مادرت"
,
"باتری تو کسس خواهر بزرگت"
,
"دیش ماهواره تو کس مادرت"
,
"ماهواره تو کس خواهرت"
,
"کنترل تلفزیون تو کون قومت"
,
"شمع تو کسس ناموست"
,
"ناموست رو اتیش شمع"
,
"شمع موتور تو کس خواهرت"
,
"فرمون موتور تو کس خواهرت"
,
"چاه اب تو کس ناموست"
,
"درام اب تو کس مردهات"
,
"کبسول اتش فشان تو کس مردهات"
,
"چکش تو کون خواهرت"
,
"دسه چکش تو کون مادرت"
,
"کیف تو کون خواهرت"
,
"ریدم دهن خواهرت"
,
"پیچ تو کس قومت"
,
"دایناسور تو کس دخترا قومت"
,
"الماس تو کس خواهرت"
,
"اهن ربا تو کسس مردهات"
,
"برینم رو قبر مردهات"

,
"شاشم دهن مردهات"

,
"گوزم دهم مادرت"

,
"سلسله اهنی تو کون خواهرت میزارم"

,
"سیگار رو کس خواهرت میزارم"
,

"شمشیر تو کس خواهرت"
,

"چاغو تو کس مادرت"

,
"لپ تاب تو کس مردهات"
,

"مردهاتو گاییدم ناموس سگ"

,
"سی دی تو کسس ددت"

,
"اچار تو کسس ددت"

,
"زربین تو کون ددت"

,
"امپول تو کس خواهرت"

,
"دوش تو کس مادرت بیناموس"

,
"وان تو کس خواهرت مادر کس کش"

,
"بادکنک تو کس خواهر ناموس هرزه"

,
"صابون گلنار تو کس خواهرت"

,
"کلید تو کس مردهات"
,

"کون مادرتو با کلید باز میکنم"
,

"زنگوله تو کس ناموست"
,

"جعبه ارایش مادرت تو کس خواهرت"
,

"رژ لب خواهرت تو کون بابات بیناموس"
,

"پاکت نامه تو کس نوامیست"
,

"تیغ تو کس خواهرت"
,

"کس خواهرت روتیغ"
,

"کشاب دفتری تو کون مادرت"
,

"سوزن تو کس مردهات"
,

"قیچی تو کس مادرت"
,

"نوار بهداشتی خواهرت دهنه بابات"

,
"کیر بابات دهنه ابجی کچلوت"

,
"مداد رنکی تو کون ابجیت"

,
"خدکار تو کس ناموست"

,
"خدکش تو کس ابجیت"
,

"قلب سیاه تو کس مردهات"
,

"علامت سوال تو کس ابجیت"
,

"باند تو کس ابجیت میزارم"
,

"وسایل ماشین تو کس ابجیت"
,

"صندلی تو کون مادرت"
,

"پاسور تو کس مردهات"

,
"پرچم ترکیه تو کس قومت"

,
"پرچم ترکیه تو کون ابجیت"

,
"پرچم المان تو کون خراب مامانت"

,
"پرچم امریکا تو کس خواهر کچلو هرزت"

,
"پرچم اتریش تو کون بابات"

,
"کیرم دهن بابات مادر کسو"

,
"پسرم هیچ وقت برا بابات شاخ نشو جوری ناموست بگائم از کون دارش میزنن بیناموس دیگ شاخ نشو"

,
"مادر کسو تو کس شاخ شدی کیرم تو خواهرت من همش ناموست میگاییدم الان شاخ شدب کسو ناموس"

,
"پشرم خواهرتو از کون دار میزنم کیرم تو جهشی کس خواهرت باشه بیناموس"

,
"ناموس کس افراشته شاخ نشو مادر کس بیا کیرم بلیس شاخ نشو مادر کس پکنیکی بیناموس"

,
"کیرم تو اقوامت هی شاخ میشی من باید ناموست بکنم کس ناموس ناموس تام"

,
"ناموس کس جری موش تو کس مادرت بره هی گو خوری میکنی مادر گاو من جوری خواهر کچلوت بکنم ک تعجب کنی مادر کس"

,
"قوم کس پلش ناموستو میکنم تو فقط نگاه میکنی تا بار بعد شاخ نشی باش بی پدر مادر"

,
"ریدم به خانوادت ناموس کس"

,
"ریدم به مردهات ناموس گاو"
,

"عنم دهنه مردهات بی خانواده"

,
"ناموست بکیرم میزارم جوری ناموست بگائم هزار روشی سامورایی"

,
"سکه تو کون خواهرت میزارم بیناموس"

,
"خواهرتو رو جاده میکشونم همه بفهمن جنده بوده"

,
"مادرتو از کونش دار بزنم صدا سگ بده قوم گاو"

,
"کیرم تو جاکشی کس مادرت بیناموس"

,
"مادر کسس جاکش دیگ شاخ نشو کیرم دهن پدرت"

,
"ناموس کس بازرگانی بیناموس خواهر جتی چرا شاخ میشی"

,
"مادر کس پکی ناموست بکیرم"

,
"تفام تو کس خواهرت بیناموس"

,
"کیرم تو لز خواهرت خواهر کس"

,
"کیرم تو درز کس خواهرت مادر کس گشاد"

,
"کیرم تو پیشونی مادرت مادر خز"

,
"کیرم تو کمر خواهرت بیناموس جک ناموس"

,
"ناموس کس دلقک حرصی میشی ناموست میکنم"

,
"جفت پام تو کسس ناموست مادر کس سیاه"

,
"دست راستم تو کسس خواهرت میزارم"

,
"دست چپم تو کسس مادرت میزارم مادر ول"

,
"مادرتو با بند میبندم میزارمش سر خیابون مادر کس"

,
"مردهات از قبر در میارم میرینم بشون"

,
"کیرم تو هرچی دار ندار مادرت"

,
"کیرم تو ضرف خواهرت"

,
"کیرم تو ضرف مادرت"

,
"اب کیرم تو تو دهن بابات بیناموس"

,
"بابات برام ساک میزنه خواهر کسه"

,
"ناموستو با خاک یکسان میکنم جد خراب"

,
"تریلی تو کون خواهرت میزارم"

,
"لودر تو کس مادرت میزارم"

,
"فرمون هواپیما تو کس مردهات پسرم"
,

"دنده ماشین تو کس خواهرت"

,
"پلاک ماشین تو کون قومت"

,
"انگشت فاک تو کسس خواهرت"

,
"با دو میام میپرم تو کس مادرت بیناموس"
,

"با دستم میزنم رو کس خواهرت تا یرمز بشه مادر کسو"

,
"کیرم تو راه رفتن مادرت بیناموس"

,
"اب کیرم رو مانتو خواهرت بیناموس"

,
"اب کیرم رو شرت بابات خواهر کسه"

,
"خایه هام دهنه خواهر مادر کسو"
,

"پشما خواهرت بکیرم مادر جن"
,

"کیرم تو جاگوزی مادرت مادر لش"
,

"کیرم تو تک تک بچه هایه قومت"
,

"کیرم تو طایفت مادر سگ"

,
"کیرم تو چالش کس خواهرت"

,
"کیرم تو صورت خواهرت مادر فلوت"

,
"کیر گوسفند تو کس قومت"

,
"قومت بکیر گوسفند"
,

"کیر شتر تو کس مردهات"
,
"کیر شتر تو قبر مردهات مادر چلاغ"

,
"مادر عقب افتاده بیناموس"

,
"کیر جن تو تک طایفت"

,
"کیر شیطان تو کون خواهرت بره"

,
"مادر کس سرطانی"

,
"مادر کس تاریخی"

,
"مادر کسس پلاستیک"
,

"مادر کس زخمی"
,

"خواهر کس پاکشتی"

,
"خواهر کس هندا"

,
"خواهر کس هندی"
,

"خواهر کس تروریست"
,

"ناموس کس داعشی"

,
"ملخ بره تو کس مادرت مادر سگ"

,
"تایر تو کس خواهرت بره"

,
"تایر هواپیما تو کون قومت"

,
"اهن هوا پیما تو کس مادرت"

,
"بال هوا پیما تو کس خواهرت"

,
"دنده ماشین تو کون ابجیت"

,
"کیلومتر تو کس ناموست"

,
"چراغ راهنما تو کس قومت"

,
"کیرم تو دخترا قومت"

,
"کیرم تو کمر دخترا قومت"

,
"قومتو از کون میکنم بیناموس"

,
"قومتو میگائم مادر کس جلقی"

,
"خواهر کس ویرایش شده"

,
"مادر کس پفیوز"

,
"مادر کس عرقی کیرم مادرت"
,

"مادر کس پارتی بیناموس"

,
"بیناموس مال کل نیستی مادر کسو مادرتو گاییدم پسرم دیگ شاخ نشو"
,

"کیرم تو قومت بیای شاخ بشی ناموست میکنم بزنی رو چتم مادر سگ"

,
"کیر تو اول اخرت تو کی اومدی مجازی شاخ شدی خواهر ول من جوری ناموست بکنم دیگ شاخ نشی"

,
"مادر کس هندی چرا شاخ میشی بلد نیستی چت کنی کیرم تو ابرو مادرت کیرم تو سولاخ مادرت شاخ نشو پسرم"

,
"خواهر کوچیکتو از دهنش میکنمش تا صدا سگ نده"
,
"ناموستو از کون میکنم صدا اه ناله هاش به گوشت برسه مادر کسو"

,
"پتو دو نفره برا خواهر کوچیکت گذاشتم میخوابونمش رو تخت کیرمو تو دهنش میزارم"

,
"من خواهر کوچیکتو میخواام فقط برام ساک بزنه بیناموس حرصی خواهر کوچیکت برا منه"

,
"قومتو میدم به سگا محلتون بکنن مادر کس برافراشته تا دیگ شاخ نشی"

,
"کیر بچه ها محلتون تو کون مادرت بیناموس"
,

"کیر هرچی بچه تو طایفتون تو کون خواهر بزرگت بی قوم کیرم مردهات"

,
"کیر بابات تو کله خواهرت مادر گوز"

,
"حساب کن بابات خواهرتو حامله کنه چی میشه مادر کسو قوم سگ"
,

"خواهرت برینه دهن بابات مادر کس"

,
"شاش خواهرت تو دهنت مادر کسو"

,
"وکیرت تو دهنه خواهر بزرگت مادر کس ول"

];
if(in_array($from_id, $data['enemies'])){
  $f = $fohsh[rand(0, count($fohsh)-1)];
  $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $f, 'reply_to_msg_id' => $msg_id]);
}
if(isset($data['answering'][$text])){
  $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $data['answering'][$text] , 'reply_to_msg_id' => $msg_id]);
    }
   }
  }
 }
} catch(\Exception $e){}	catch(\danog\MadelineProto\RPCErrorException $e){}
 }
}

register_shutdown_function('shutdown_function', $lock);
closeConnection();
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
  yield $MadelineProto->setEventHandler('\EventHandler');
});

$MadelineProto->loop();

