<?php

require($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/lib/phpmailer/class.phpmailer.php');
require($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/lib/phpmailer/class.smtp.php');
/**
 * Created by PhpStorm.
 * User: Michele Iessi
 * Date: 02/07/2016
 * Time: 19:57
 */
class UMail {
    private $mail;

    public function __construct()
    {
        global $config;
        $this->mail = new PHPMailer();
        $this->mail->IsSMTP();
        $this->mail->Host = $config['smtp']['host'];
        $this->mail->Port = $config['smtp']['port'];
        $this->mail->SMTPAuth = $config['smtp']['smtpauth'];
        $this->mail->Username = $config['smtp']['username'];
        $this->mail->Password = $config['smtp']['password'];
        $this->mail->CharSet = 'utf-8';
        $this->mail->setFrom($config['smtp']['username'],'Appointment Manager');
        $this->mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    }

    public function inviaMail($mailDest,$nomeDest,$oggetto,$corpoMail,$html=false)
    {
        $this->mail->AddAddress($mailDest, $nomeDest);
        $this->mail->Subject = $oggetto;
        $this->mail->Body = $corpoMail;
        $this->mail->IsHTML($html);

        if(!$this->mail->Send())
        {
            return false;
        }
        else return true;
    }
}
?>
