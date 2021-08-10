# php-starter

If you are reading this in your assignment repo, please read [assignment submission guidelines](https://learn.rtcamp.com/campus/php-assignments/guidelines/) before proceeding.

Then make sure to replace content of the file with information relevant to your assignment. 

Writing your own README.md file is required anyway as per [assignment submission guidelines](https://learn.rtcamp.com/campus/php-assignments/guidelines/).

In this project I have completed  Email a random XKCD challenge using HTML,CSS,JS,PHP and MySQL.

I have hosted the live project on http://assignment-aw.lovestoblog.com which is a free domain provided by infinityfree.

I have used 8 files and 1 folders.

The images folder stores the image from XKCD api and sends it to the user.

Mails are sent using JavaScript.

The main file of the project is index.html which contains the form where user will enter his/her email id ,and further will be directed to otp.html where the verification of otp will take place and the email id would be added to our mailing list.If the user fails to verify the OTP ,it will be redirected to fail.html otherwise to success.html.

At backend from index.html the control goes to action.php where the OTP is sent to provided mail id.Again from otp.html the control comes to action.php for otp verification.

If user click the unsubscribe link in the email an OTP will be sent to their email address and later  if verified user will be unsubscribed.

When the user hits the link control is sent to send.php file which will send the OTP to the user,and directed to delete.html where user will enter the OTP recieved and will be verified at delete.php .

The cron_job.php file is used for scheduling the mails every 5 minutes to the users in mailing list.

