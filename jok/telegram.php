<?php
class telegram {
    
    
    public $token;
    public $db;
    public $queryResult;
    public $query;
    
    public function __construct($token,$host,$username,$password,$dbname)
    {
        $this->token =    $token; 
        
        $this->db = mysqli_connect($host,$username,$password,$dbname);
        if(mysqli_connect_errno())
        {
            echo 'DB CONNECTION ERROR';
            die;
        }else
        {
            mysqli_query($this->db , 'SET NAMES UTF8');
        }
        
    }
        
    public function __destruct()
    {
        mysqli_close($this->db);
    }
    
    
    public function runQuery()
    {
        $this->queryResult = mysqli_query($this->db,$this->query);
    }
    
    // دریافت اطلاعات بات
    public function getMe()
    {
        $url = 'https://api.telegram.org/bot'.$this->token.'/getMe';
        return file_get_contents($url) ;
    }
    
    
        // دریافت اطلاعات ارسال شده به بات
    public function getUpdates()
    {
        $url = 'https://api.telegram.org/bot'.$this->token.'/getUpdates';
        return file_get_contents($url) ;
    }
    
    
    // متد دریافت اطلاعات از کاربر
    public function recivedText()
    {
        $text = json_decode(file_get_contents('php://input'));
        return $text;
    }
    
    
    // متد ارسال پیام به کاربر
    public function sendMessage($userid,$text)
    {
        $url = 'https://api.telegram.org/bot'.$this->token.'/sendMessage?chat_id='.$userid.'&text='.$text;
        file_get_contents($url) ;
    } 
    
        
    // متد ارسال پیام به کاربر
    public function sendMessage2($userid,$text,$options)
    {
        $url = 'https://api.telegram.org/bot'.$this->token.'/sendMessage';
        
        $keyboard = $this->makeMenu($options);

        $post_fields =  array(
            'chat_id' => $userid ,
            'text' => $text ,
            'reply_markup' => $keyboard
        );
        $this->executeCURL($url,$post_fields);
    } 
    
    
    // متد ایجاد عناوین منو یا همان کیبرد
    public function makeMenu($options)
    {
        
        $keyboard = Array(
            'keyboard' => $options ,
            'resize_keyboard' => true ,
            'one_time_keyboard' => false ,
            'selective' => true
        );
        
        return json_encode($keyboard);
    }
    
    
    public function sendPhoto($userid,$caption,$options)
    {
        $url = 'https://api.telegram.org/bot'.$this->token.'/sendPhoto';
        
        $keyboard = $this->makeMenu($options);

        $post_fields =  array(
            'chat_id' => $userid ,
            'photo' => new CURLFILE($this->randomImage()) ,
            'caption' => $caption ,
            'reply_markup' => $keyboard
        );
        $this->executeCURL($url,$post_fields);
    }
    
    
    public function randomImage()
    {
        $imagesDir = 'images/';
        $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        return $images[array_rand($images)]; // See comments        
    }
    
    
    /// متد curl
    public function executeCURL($url,$post_fields)
    {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type:multipart/form-data"
                ));
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
        $output = curl_exec($ch);
    }
    
}

