<?php

require($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/lib/phpmailer/class.phpmailer.php');
require($_SERVER["DOCUMENT_ROOT"].'/appointment-manager/lib/phpmailer/class.smtp.php');

/**
 * UMail si occupa di inviare email. Viene usato per la gestione delle registrazioni e per notificare clienti e professionisti
 * della cancellazione di appuntamenti che li interessavano.
 *
 * @package  Utility
 * @author   Michele Iessi
 * @author   Davide Iessi
 * @author   Andrea Pagliaro
 * @access   public
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

    /** Invia un EMail usando phpmailer.
     * @param $mailDest string L'indirizzo email al quale inviare una mail.
     * @param $nomeDest string Il nome del destinatario del messaggio.
     * @param $oggetto string L'oggetto della mail.
     * @param $corpoMail string Il corpo (testo) della mail.
     * @param bool $html se il corpo della mail è codice html, va messo a true.
     * @return bool true se la mail è stata inviata con successo, false altrimenti
     * @throws phpmailerException
     */
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
