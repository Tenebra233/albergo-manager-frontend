<?php

require_once('/var/www/html/albergo-wp/SwaggerClient-php/vendor/autoload.php');

class FormGenerator
{
    //    private $servername = "localhost";
    //    private $username = "root";
    //    private $password = "pippo";
    //    private $dbname = "nova-test";
    //test
    private $form;
    private $name;
    private $email;
    private $password;
    private $note;

    public static function Hooks()
    {
        $me = new self();
        require_once '/var/www/html/albergo-wp/vendor/formr/formr/class.formr.php';

        add_action('wp_enqueue_scripts', [$me, 'your_theme_enqueue_scripts']);
        add_action('wp_head', [$me, 'sendInfo']);
        add_shortcode('form-test', [$me, 'form_test']);
        $me->form = new Formr('bootstrap');


    }

    public function your_theme_enqueue_scripts()
    {
        // all styles
        wp_enqueue_style('bootstrap', '/css/bootstrap.css', array(), 20141119);
        // all scripts
        wp_enqueue_script('bootstrap', '/js/bootstrap.min.js', array('jquery'), '20120206', TRUE);
    }

    public function form_test()


    {

        ob_start();
        echo $this->form->form_open();
        echo $this->form->input_text('name', 'Nome');
        echo $this->form->input_email('email', 'Email');
        echo $this->form->input_password('password', 'Password');
        echo $this->form->input_datetime_local('data_da', 'Dal');
        echo $this->form->input_datetime_local('data_a', 'Al');
        echo $this->form->input_textarea('note', 'Note');
        echo $this->form->input_submit();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;

    }

    public function sendInfo()
    {


        if ($this->form->submitted()) {
            $test = new \Swagger\Client\Api\FlussoPrenotazioneApi();
            $body = new \Swagger\Client\Model\Body1([
                'name' => $this->form->post('name'),
                'email' => $this->form->post('email'),
                'password' => $this->form->post('password'),
                'data' => "2020-09-28 10:00:00",
                "data_da" => "2020-09-28 10:00:00",
                "data_a" => "2020-09-28 10:00:00",
                "aliquota_iva" => "22",
                "totale" => "1000",
                "data_prenotazione" => "2020-09-28 10:00:00",
                "note" => $this->form->post('note'),
                "status" => "S",
            ]);
            $test->flussoPrenotazione($body);

        }
    }

}