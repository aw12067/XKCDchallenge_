<?php

require  __DIR__. '/config.php';

$servername=$server;
$username=$name;
$password=$dbpass;
$dbname=$dname;
$con=new mysqli($servername,$username,$password,$dbname);

        $map_url = "https://xkcd.com/".rand(0,2900)."/info.0.json";
        $maps_json = file_get_contents($map_url);
        $maps_array = json_decode($maps_json,true);
        $url = $maps_array['img'];
        $pathinfo = pathinfo($url); // To get the filename and extension
        $ext = $pathinfo['extension']; 
        $filename = 'images/'.$pathinfo['filename']; 
        $img = file_get_contents($url,true); // get the image from the url
        file_put_contents($filename.'.'.$ext, $img); // create a file and feed th

        
        
        $resc=array();
        $sqlselect="select email from sends";
        $result = $con->query($sqlselect);
        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                $data = $row["email"];
                array_push($resc, $data);
            }
        }
        
        $ciphering = "AES-128-CTR";
  
        // Use OpenSSl Encryption method
        
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $iv = '1234567891011121';
        
        // Store the encryption key
        $key = "encrypthere";

            foreach($resc as $send)
            {
                $link = "http://assignment-aw.lovestoblog.com/send.php?email=".$send;
                $bodyHtml = '<img src='.$url.' width="300px" height="150px"><a href='.$link.' style="text-align:center;margin-top: 20px;">Unsubscribe</a>';
                echo '
            <script src="https://smtpjs.com/v3/smtp.js"></script>
            <script type="text/javascript">
                
                    Email.send({
                    Host: "smtp.gmail.com",
                    Username : "'.openssl_decrypt ($usernameSmtp, $ciphering,$key, $options, $iv).'",
                    Password : "'.openssl_decrypt ($passwordSmtp, $ciphering,$key, $options, $iv).'",
                    To : "'.$send.'",
                    From : "ashwinwalunj@gmail.com",
                    Subject : "'.$subject.'",
                    Body : "'.$bodyHtml.'",
                    Attachments : [
                    {
                        name : "'.$pathinfo['filename'].'.png",
                        path:"'.$path.'"
                    }]
                    }).then(
                        message => window.location.replace("assignment-aw.lovestoblog.com")
                    );
            </script>
        ';
            }
?>
