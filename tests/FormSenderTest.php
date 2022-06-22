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
        $this->assertEquals($result, true);

        $post = [
            'test@test.test',
            'test.ru',
        ];
        $result = $form_sender->validateArray($post);
        $this->assertEquals($result, false);

        $post = [
            '@test.test',
            'https://test.ru',
        ];
        $result = $form_sender->validateArray($post);
        $this->assertEquals($result, false);

        $post = [
            '@test.test',
            'test.ru',
        ];
        $result = $form_sender->validateArray($post);
        $this->assertEquals($result, false);

        $mock = $this->createMock(FormSender::class);
        $result = $mock->method('sendMail')->willReturn(true);
        $this->assertEquals($result, true);
    }
}