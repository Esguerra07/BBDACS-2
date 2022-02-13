<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "bbdacswebsite@gmail.com"; //enter you email address
        $mail->Password = 'bbdacs123'; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";


        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("edwardcubos@gmail.com");
        $mail->addAddress("danielesguerra070400@gmail.com");
        $mail->addAddress("tamayojomar045@gmail.com");
        $mail->addAddress("aikamanahan72@gmail.com");
        $mail->addAddress("terbuensuceso@gmail.com");
        $mail->addAddress("russeltamonang9@gmail.com");
        $mail->addAddress("irishjoysantos28@gmail.com");
        $mail->addAddress("Lopezjomar98@gmail.com");
        $mail->addAddress("saileenmay@gmail.com");
        
         //enter you email address
        $mail->Subject = ("Stay safe Bulakenyo's ($subject)");
        $mail->Body = $body;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
