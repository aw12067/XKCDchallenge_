<?php

require  __DIR__. '/config.php';

$servername=$server;
$username=$name;
$password=$dbpass;
$dbname=$dname;
$con=new mysqli($servername,$username,$password,$dbname);

if(isset($_GET['email']))
{
	$email = test_input($_GET['email']);

	$otp = rand(9999,100000);

    
    $ciphering = "AES-128-CTR";
  
        // Use OpenSSl Encryption method
        
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $iv = '1234567891011121';
        
        // Store the encryption key
        $key = "encrypthere";

        
    $subject = 'OTP Verification';

    // The plain-text body of the email
    $bodyText =  "Your OTP is ".$otp;

    // The HTML-formatted body of the email
    $bodyHtml = " Your OTP is ".$otp;

    $sqldelete="DELETE from deletion where email='$email'";
        $con->query($sqldelete);
        $sqlinsert="insert into deletion values('$email','$otp')";
        $con->query($sqlinsert);

    echo '
            <script src="https://smtpjs.com/v3/smtp.js"></script>
            <script type="text/javascript">
                
                    Email.send({
                    Host: "smtp.gmail.com",
                    Username : "'.openssl_decrypt ($usernameSmtp, $ciphering,$key, $options, $iv).'",
                    Password : "'.openssl_decrypt ($passwordSmtp, $ciphering,$key, $options, $iv).'",
                    To : "'.$email.'",
                    From : "ashwinwalunj@gmail.com",
                    Subject : "'.$subject.'",
                    Body : "'.$bodyHtml.'",
                    }).then(
                        message => window.location.replace("assignment-aw.lovestoblog.com/delete.html")
                    );
            </script>
        ';
}
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}  

?>