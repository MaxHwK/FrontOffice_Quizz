<?php

namespace Framework\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Framework\Controller\CrudUserController;

Class SendEmail
{
    public function SendEmail($players, $hash)
    {

        $crud = new CrudUserController();

        foreach ($players as $key => $value) {
        
            if($value !== '') {
                $get = $crud->getEmailByUsername($value);
                
                foreach ($get as $getMail) {

                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = "tls";
                        $mail->Port = "587";
                        $mail->Username = "quizz.in.game@gmail.com";
                        $mail->Password = "Max&Flav2022";

                        $mail->SMTPOptions = array(
                            'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                            )
                        );
                    
                        $mail->setFrom('quizz.in.game@gmail.com', 'Quizz-In game');
                        $mail->addAddress($getMail['email']);
                    
                        $object = "http://localhost:3000/games/Quizz-In?user=" . $value . "&hash=" . $hash;
                    
                        $mail->Subject = "Invitation a une partie du jeu Quizz-In";
                        $mail->isHTML(true);
                        $mail->Body = "<p>Bonjour,</p>
                            <p>Vous avez été invité à rejoindre une partie du jeu Quizz-In, dont voici le lien :</p>
                            <p><a href='{$object}' target='_blank'>{$object}</a></p><p>Bonne journée et surtout bon jeu !</p>
                            <font color='grey'>
                                <p>_______________</p>
                                <p>L'équipe du jeu Quizz-In - LAMBERT Flavien & GIRON Maxence</p>
                            </font>";

                        $mail->send();
                    
                    } catch (Exception $e) {
                        echo "Erreur rencontré, l'email n'a pas été envoyé !" . $e->getMessage();    
                    }
                }
            }
        }
    }
}


