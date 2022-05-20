<?php

class FormSender
{
    protected $err = [];
    /**
     * @var string
     */
    /**
     * @throws Exception
     */
    public function validateArray($postArray = []) {
        if (isset($postArray['email']) && isset($postArray['URL'])) {
            $this->err['fatality'] = 'Missing Email or URL fields';
            return;
        }
        $dataEmail = $postArray['email'];
        $dataUrl = $postArray['URL'];
        if (! filter_var($dataEmail, FILTER_VALIDATE_EMAIL)) {
            $this->err['email'] = 'Invalid email! Please, check email.';
        }
        if (! filter_var($dataUrl, FILTER_VALIDATE_URL)) {
            $this->err['URL'] = 'Invalid URL! Please, check URL.';
        }
    }
    public function sendMail($to = '', $subject = '', $message = '', $headers = []) {
        mail($to, $subject, $message, $headers);
    }
    public function getErr() {
        return $this->err;
    }
}
$form_sender = new FormSender();
$form_sender->validateArray($_POST);
$arrayErr = $form_sender->getErr();
if (empty($arrayErr)) {
    $form_sender->sendMail($_POST['email'], $_POST['subject'], $_POST['message'], $_POST['headers']);
}