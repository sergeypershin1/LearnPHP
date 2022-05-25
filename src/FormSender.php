<?php
namespace Sergeypershin\Form;

class FormSender
{
    protected $err = []; //errrors

    /**
     * @param array $postArray
     * @return bool
     */
    public function validateArray(array $postArray = []) : bool {
        if (! isset($postArray['email']) && ! isset($postArray['URL'])) {
            $this->err['fatality'] = 'Missing Email or URL fields';
            return false;
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

    /**
     * @param array $postArray
     * @return false
     */
    public function execute(array $postArray = []){
        if($this->validateArray($postArray)){
            //return $this->sendMail();
        }
        return false;
    }

    public function sendMail($to = '', $subject = '', $message = '', $headers = []) : bool {
        //нет проверки try
        // Отправить $message на русском языке UTF-8
        mail($to, $subject, $message, $headers);
    }
    public function getErr() {
        return $this->err;
    }
}

