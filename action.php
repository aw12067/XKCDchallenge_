<?php

require  __DIR__. '/config.php';

$servername=$server;
$username=$name;
$password=$dbpass;
$dbname=$dname;
$con=new mysqli($servername,$username,$password,$dbname);

$ciphering = "AES-128-CTR";
        
$options = 0;

$iv = '1234567891011121';

$key = "encrypthere";


if (isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST['form1']) && isset($_POST['email']))
{
    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    $name = $fname." ".$lname;
    $email = test_input($_POST['email']);
    mysql_real_escape_string($mail);

    $otp = rand(9999,100000);

    $sqldelete="DELETE from user where email='$email'";
        if($con->query($sqldelete)==TRUE)
        {

        }
        $sqlinsert="insert into user values('$email','". date("Y-m-d H:i:s")."','$otp')";
        if($con->query($sqlinsert)==TRUE)
        {

        }

    echo '
            <script src="https://smtpjs.com/v3/smtp.js"></script>
            <script type="text/javascript">
                
                    Email.send({
                    Host: "smtp.gmail.com",
                    Username : "'.openssl_decrypt ($usernameSmtp, $ciphering,$key, $options, $iv).'",
                    Password : "'.openssl_decrypt ($passwordSmtp, $ciphering,$key, $options, $iv).'",
                    To : "'.$email.'",
                    From : "ashwinwalunj@gmail.com",
                    Subject : "OTP Verification for subsrciption.",
                    Body : "Hi '.$name.'.Your OTP is '.$otp.'",
                    }).then(
                        message => window.location.replace("assignment-aw.lovestoblog.com/otp.html")
                    );
            </script>
        ';

}
if (isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST['form2']))
{
    $num = test_input(isset($_POST['otp']));
    $email = test_input(isset($_POST['email']));
    mysql_real_escape_string($num);
    mysql_real_escape_string($mail);

    $sqlselect="select * from user where email='$email' and otp='$num' ";   //and NOW()<=date_add(time,INTERVAL 10 MINUTE)";
    $result = $con->query($sqlselect);
    if($result->num_rows>0)
    {
        $sqlinsert="insert into sends values('$email')";
        if($con->query($sqlinsert)==TRUE)
        {
        }
        $sqldelete="delete from user where email='$email'";
        if($con->query($sqldelete)==TRUE)
        {}
        $map_url = "https://xkcd.com/".rand(0,2900)."/info.0.json";
        $maps_json = file_get_contents($map_url);
        $maps_array = json_decode($maps_json,true);
        $url = $maps_array['img'];
        $pathinfo = pathinfo($url); // To get the filename and extension
        $ext = $pathinfo['extension']; 
        $filename = 'images/'.$pathinfo['filename']; 
        $img = @file_get_contents($url,true); // get the image from the url
        file_put_contents($filename.'.'.$ext, $img); // create a file and feed th
        $path = $filename.".".$ext;

        $link = "http://assignment-aw.lovestoblog.com/delete.php?email='".$email."'";
        $bodyHtml = '<img src='.$url.' width="300px" height="150px"><a href='.$link.' style="text-align:center;margin-top: 20px;">Unsubscribe</a>';

        
        echo '
            <script src="https://smtpjs.com/v3/smtp.js"></script>
            <script type="text/javascript">
                
                    Email.send({
                    Host: "smtp.gmail.com",
                    Username : "'.openssl_decrypt ($usernameSmtp, $ciphering,$key, $options, $iv).'",
                    Password : "'.openssl_decrypt ($passwordSmtp, $ciphering,$key, $options, $iv).'",
                    To : "'.$email.'",
                    From : "ashwinwalunj@gmail.com",
                    Subject : "'.$subject.'"",
                    Body : "'.$bodyHtml.'",
                    Attachments : [
                    {
                        name : "'.$pathinfo['filename'].'.png",
                        path:"'.$path.'"
                    }]
                    }).then(
                        message => window.location.replace("assignment-aw.lovestoblog.com/success.html")
                    );
            </script>
        ';
        
    }
    else
    {
        header("location: fail.html");
    }
}
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>