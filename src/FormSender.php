<?php
namespace Sergeypershin\Form;

class FormSender
{
    protected $errors = []; //array errors

/**
* @param array $postArray
* @return bool
*/
    public function validateArray(array $postArray = []) : bool
    {
        if (! isset($postArray['email']) && ! isset($postArray['URL'])) {
            $this->errors[] = 'Missing Email or URL fields';
            return false;
        }
        $dataEmail = $postArray['email'];
        $dataUrl = $postArray['URL'];
        if (! filter_var($dataEmail, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Invalid email! Please, check email.';
            return false;
        }
        if (! filter_var($dataUrl, FILTER_VALIDATE_URL)) {
            $this->errors[] = 'Invalid URL! Please, check URL.';
            return false;
        }

        return true;
    }

/**
* @param array $postArray
* @return false
*/
    public function execute(array $postArray = [])
    {
        if($this->validateArray($postArray)){
            return $this->sendMail($postArray['email'], $postArray['URL']);
        }
        return false;
    }

    public function sendMail($to, $subject, $message = '', $headers = []) : bool
    {
        //нет проверки try
        // Отправить $message на русском языке UTF-8
        if (! $to) {
            $this->errors[] = 'Empty field to whom to deliver';
            return false;
        }
        if (! $message) {
            $this->errors[] = 'Empty message';
            return false;
        }

        $message = utf8_encode($message);

        try {
            if (! mail($to, $subject, $message, $headers)) {
                $this->errors[] = "Send error!";
                return false;
            }
            return true;
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }

    }

    public function getErrors()
    {
        return $this->errors;
    }
}