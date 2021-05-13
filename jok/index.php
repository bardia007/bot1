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



if ($text == '/start')
{
    $text ='کاربر گرامی با انتخاب یکی از منوها میتوانید جک ، تصویر و یا سخن پند آموز دریافت کنید';
        $options = Array(
            array('جک','تصویر'),
            array('سخن','راهنما')
        );
        
    
    $telegram->sendMessage2($userid,$text,$options); 
}




if ($text == '/joke' or $text == 'جک')
{
    
    
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
    $joke = strip_tags($result->fetch_object()->post_content);
    
        $options = Array(
            array('جک','تصویر'),
            array('سخن','راهنما')
        );
        
    
    $telegram->sendMessage2($userid,$joke,$options); 
}




if ($text == '/pic' or $text == 'تصویر')
{
        $options = Array(
            array('جک','تصویر'),
            array('سخن','راهنما')
        );
    
   $caption = 'تصویر جذاب و دیدنی توسط بات جک گو 😂😂
👏👏👏 @webmomjoke_bot';
   $telegram->sendPhoto($userid,$caption,$options);
}




if ($text == '/help' or $text == 'راهنما')
{
       $help = urlencode( '⚙ راهنمای استفاده از ربات جک گو:
✅ برای ارسال جک به صورت تصادفی کافیست که دستور /joke را ارسال کنید.😂😂
✅ برای ارسال عکس از دستور /pic استفاده کنید ..
➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖
امیدواریم که این بات باعث شادی و خنده ی شما گردد
👏👏👏 @webmomjoke_bot');
   $telegram->sendMessage($userid,$help);  
}



if ($text == '/sokhan' or $text == 'سخن')
{
    /// اتصال به جدول وردپرس
    $query = "SELECT * FROM yt6ho_term_relationships JOIN yt6ho_posts on object_id= ID WHERE                       term_taxonomy_id = 3 ORDER BY RAND() LIMIT 1";
    $telegram->query = $query;
    $telegram->runQuery();
    $result = $telegram->queryResult;    
    $sokhan = strip_tags($result->fetch_object()->post_content);
    
            $options = Array(
            array('جک','تصویر'),
            array('سخن','راهنما')
        );
        
    $telegram->sendMessage2($userid,$sokhan,$options); 
}



