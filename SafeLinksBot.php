<?php
// TTTT = Token
define('API_KEY','TTTT');
// AAAA = Admin's Chat ID
$admin = "AAAA";
function mute($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
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
$update = json_decode(file_get_contents('php://input'));
$chat_id = $update->message->chat->id;
$text = $update->message->text;
$from = $update->message->from->id;
  if(preg_match('/^([Hh]ttp|[Hh]ttps)(.*)/',$text)){
    mute('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"🤖 لطفا صبور باشید ...",
      'parse_mode'=>'HTML'
    ]);
    $short = file_get_contents('https://safelinks.ir/api?api=%%SafeLinksAPI%%&url='.$text.'&format=text');
    mute('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"🔗 لینک کوتاه : ".$short."\n\n@SafeLinksBot",
      'parse_mode'=>'HTML'
    ]);
    mute('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"🤖 برای استفاده از امکانات بیشتر از نسخه وب سیف لینکس استفاده کنید .\n\nhttps://SafeLinks.ir",
      'parse_mode'=>'HTML'
    ]);
  }
  if(preg_match('/^\/([sS]tart)/',$text)){
	  mute('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"سلام 😉👋\nبه امن ترین ربات کوتاه کننده لینک خوش اومدی 😃\nلینک طولانی رو بفرست تا کوتاهش کنم 🙌\n\n@SafelinksBot",
      'parse_mode'=>'HTML'
    ]);
  }
  if(preg_match('/^\/([Mm]ember)/',$text) and $from == $admin){
    $user = file_get_contents('user.txt');
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
    mute('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"👤 تعداد کاربران : $member_count",
      'parse_mode'=>'HTML'
    ]);
}
$user = file_get_contents('user.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('user.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('user.txt',$add_user);
    }
	?>
// www.AliKarbasi.com
// Info@AliKarbasi.com
