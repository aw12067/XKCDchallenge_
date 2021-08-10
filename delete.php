<?php

$servername='sql303.epizy.com';
$username='epiz_29098706';
$password='ashwinawashwin';
$dbname='epiz_29098706_verification';
$con=new mysqli($servername,$username,$password,$dbname);


if(isset($_POST['otp']) && isset($_POST['email']))
{
    $num = test_input($_POST['otp']);
    $email = test_input($_POST['email']);
    mysql_real_escape_string($num);
    mysql_real_escape_string($email);
    $sqlselect="select * from deletion where email='$email' and otp='$num' ";//and NOW()<=date_add(time,INTERVAL 10 MINUTE)";
    $result = $con->query($sqlselect);
    if($result->num_rows>0)
    {
        $sqldelete="delete from sends where email='$email'";
        if($con->query($sqldelete)==TRUE)
        {
            $sqldelete1="delete from deletion where email='$email'";
            $con->query($sqldelete1);
            echo "<div>
                    <h1 style='text-align:center;margin-top: 20px;'>Record deleted succesfully for ". $email."</h1>
                </div>";
        }
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