<?php
use PHPUnit\Framework\TestCase;
use Sergeypershin\Form\FormSender;

class FormSenderTest extends TestCase
{

    public function testValidate()
    {
        $form_sender = new FormSender();

        $post = [
            'email@email.co',
            'https://test.ru',
        ];
        $result = $form_sender->validateArray($post);

        $post = [
            'test@test.test',
            'test.ru',
        ];
        $result = $form_sender->validateArray($post);

        $post = [
            'email@email.co',
            'test.ru',
        ];
        $result = $form_sender->validateArray($post);

        $this->assertEquals($result, false);

        $arrayErr = $form_sender->getErrors();
        if (empty($arrayErr)) {
            $form_sender->sendMail($_POST['email'], $_POST['subject'], $_POST['message'], $_POST['headers']);
        }
    }
}