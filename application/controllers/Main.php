<?php
// require 'vendor/autoload.php';

// use \Mailjet\Resources;

class Main extends CI_Controller
{

    public function index()
    {
        $this->load->view("template/header");
        $this->load->view("pages/home");
        $this->load->view("template/footer");
    }

    public function test()
    {
        // $mj = new \Mailjet\Client('113e4db7447829d6880644ecb1933229', '81f5f5b9a7f65f6a826c549a08cd9713', true, ['version' => 'v3.1']);
        // $body = [
        //     'Messages' => [
        //         [
        //             'From' => [
        //                 'Email' => "wyrlvillazorda@gmail.com",
        //                 'Name' => "Wyr'l"
        //             ],
        //             'To' => [
        //                 [
        //                     'Email' => "wyrlvillazorda@gmail.com",
        //                     'Name' => "Wyr'l"
        //                 ]
        //             ],
        //             'Subject' => "Greetings from Mailjet.",
        //             'TextPart' => "My first Mailjet email",
        //             'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
        //             'CustomID' => "AppGettingStartedTest"
        //         ]
        //     ]
        // ];
        // $response = $mj->post(Resources::$Email, ['body' => $body]);

        // var_dump($response->getData());
        //$response->success() && var_dump($response->getData());


        require 'vendor/autoload.php'; // If you're using Composer (recommended)
        // Comment out the above line if not using Composer
        // require("<PATH TO>/sendgrid-php.php");
        // If not using Composer, uncomment the above line and
        // download sendgrid-php.zip from the latest release here,
        // replacing <PATH TO> with the path to the sendgrid-php.php file,
        // which is included in the download:
        // https://github.com/sendgrid/sendgrid-php/releases

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("wyrlvillazorda@gmail.com", "Example User");
        $email->setSubject("Sending with SendGrid is Fun");
        $email->addTo("wyrlvillazorda@gmail.com", "Example User");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html",
            "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}
