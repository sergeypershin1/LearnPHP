<?php
use PHPUnit\Framework\TestCase;
use Sergeypershin\Form\FormSender;

class FormSenderTest extends TestCase
{

    public function testValidate()
    {
        $mock = $this->creatMock(FormSender::class);
        $post = [];
        $form_sender = new FormSender();
        $result = $form_sender->validateArray($post);
        $this->assertEquals($result, false);
        /*$arrayErr = $form_sender->getErr();
        if (empty($arrayErr)) {
            $form_sender->sendMail($_POST['email'], $_POST['subject'], $_POST['message'], $_POST['headers']);
        }*/
    }
}