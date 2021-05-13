<?php

require ('config.php');
require ('telegram.php');

$telegram = new telegram(TOKEN,HOST,USERNAME,PASSWORD,DBNAME);


//echo $telegram->getMe();

//echo $telegram->getUpdates();

// دریافت اطلاعات ارسال شده به بات و تبدیل آن به آرایه
$result =  $telegram->recivedText();

$userid = $result->message->from->id;
$text   = $result->message->text;


//$text ="پیام شما دریافت شد با تشکر به زودی با شما تماس خواهیم گرفت";

// ارسال پیام به کاربر
//$telegram->sendMessage($userid,$text);


if ($text == '/joke')
{
    /// کوئری اتصال به جدول jokego
//    $query = "SELECT * FROM joke ORDER BY RAND() LIMIT 1";
//    $telegram->query = $query;
//    $telegram->runQuery();
//    $result = $telegram->queryResult;
//    $joke = urlencode($result->fetch_object()->joke);    
    
    /// اتصال به جدول جوملایی
//    $query = "SELECT * FROM weg8o_content WHERE catid=8 ORDER BY RAND() LIMIT 1";
//    $telegram->query = $query;
//    $telegram->runQuery();
//    $result = $telegram->queryResult;    
//    $joke = urlencode(strip_tags($result->fetch_object()->introtext));
//    
//    

    /// اتصال به جدول وردپرس
    $query = "SELECT * FROM yt6ho_term_relationships JOIN yt6ho_posts on object_id= ID WHERE                       term_taxonomy_id = 2 ORDER BY RAND() LIMIT 1";
    $telegram->query = $query;
    $telegram->runQuery();
    $result = $telegram->queryResult;    
    $joke = urlencode(strip_tags($result->fetch_object()->post_content));
    
   
    
    $telegram->sendMessage($userid,$joke); 
}




if ($text == '/pic')
{
       $pic = 'تصویر ارسال شد';
   $telegram->sendMessage($userid,$pic);  
}




if ($text == '/help')
{
       $help = urlencode( '⚙ راهنمای استفاده از ربات جک گو:
✅ برای ارسال جک به صورت تصادفی کافیست که دستور /joke را ارسال کنید.😂😂
✅ برای ارسال عکس از دستور /pic استفاده کنید ..
➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖
امیدواریم که این بات باعث شادی و خنده ی شما گردد
👏👏👏 @webmomjoke_bot');
   $telegram->sendMessage($userid,$help);  
}



if ($text == '/sokhan')
{
       $sokhan = 'یک سخن ارسال شد';
   $telegram->sendMessage($userid,$sokhan);  
}



