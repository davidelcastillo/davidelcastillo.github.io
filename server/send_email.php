<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';

    if(isset($_POST['send'])){

        session_start();
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gibsonlenguajes@gmail.com';
        $mail->Password = 'kqtkgdodkivkibup';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $subject = 'Subject: '.$_POST['subject'] . ' From : '.$_POST['email'];

        $message = $_POST['message']. ' FROM : ' .$_POST['email'];

        $mail->setFrom($_POST['email']);

        $mail->addAddress('gibsonlenguajes@gmail.com');

        $mail->isHTML(true);

        $mail->Subject = $subject;

        $mail->Body = $message;

        $mail->send();


        header('Location: ../index.php?email_snt=Sent Successfully');

    }

?>