<?php

require_once('/var/www/html/albergo-wp/SwaggerClient-php/vendor/autoload.php');

class FormGenerator
{


    private $servername = "localhost";
    private $username = "root";
    private $password = "pippo";
    private $dbname = "nova-test";
    private $form;

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
        wp_enqueue_script('bootstrap', '/js/bootstrap.min.js', array('jquery'), '20120206', true);
    }

    public function form_test()


    {

        $form = new Formr();
        echo $form->form_open();
        echo $form->input_text('name', 'Nome');
        echo $form->input_email('email', 'Email');
        echo $form->input_password('password', 'Password');
        echo $form->input_textarea('note', 'Note');
        echo $form->input_submit();

    }

    public function sendInfo()
    {


        if ($this->form->submitted()) {
            $test = new Swagger\Client\Api\RegisterApi();
            $body = new \Swagger\Client\Model\Body2([
                'id'=>666,
                'name'=>'swaggsdetest',
                'email'=>'ajfioajof@sdgmaasd.com',
                'password'=>'aajioajofija123dd'
            ]);
            $test->registerUserWithHttpInfo($body);

            $name = $this->form->post('name');
            $email = $this->form->post('email');
            $password = $this->form->post('password');
            $note = $this->form->post('note');


            //FLUSSO 1
//            $createUser = curl_init();
//
//            curl_setopt_array($createUser, array(
//                CURLOPT_URL => "http://laravel.dev/api/users",
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "POST",
//                CURLOPT_POSTFIELDS => "name=$name&email=$email&password=$password",
//                CURLOPT_HTTPHEADER => array(
//                    "Content-Type: application/x-www-form-urlencoded"
//                ),
//            ));
//
//
//            $userResponse = curl_exec($createUser);
//            $userJson = json_decode($userResponse, true);
//            $userId = $userJson['id'];
//
//            //FLUSSO 2
//
//            $createFattura = curl_init();
//
//            curl_setopt_array($createFattura, array(
//                CURLOPT_URL => "http://laravel.dev/api/fattura",
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "POST",
//                CURLOPT_POSTFIELDS => "data=2020-09-02 12:00:00&aliquota_iva=22&totale=100&user_id=$userId",
//                CURLOPT_HTTPHEADER => array(
//                    "Content-Type: application/x-www-form-urlencoded"
//                ),
//            ));
//
//
//            $fatturaResponse = curl_exec($createFattura);
//            $fatturaJson = json_decode($fatturaResponse, true);
//            $fatturaId = $fatturaJson['id'];
//
//            //FLUSSO 3
//            $createPrenotazione = curl_init();
//
//            curl_setopt_array($createPrenotazione, array(
//                CURLOPT_URL => "http://laravel.dev/api/prenotazione",
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "POST",
//                CURLOPT_POSTFIELDS => "data_prenotazione=" . date('Y-m-d') . "&note=$note&status=S&fattura_id=$fatturaId",
//                CURLOPT_HTTPHEADER => array(
//                    "Content-Type: application/x-www-form-urlencoded"
//                ),
//            ));
//
//
//            $test = curl_exec($createPrenotazione);
//
//            curl_close($createPrenotazione);
//            curl_close($createFattura);
//            curl_close($createUser);


        }
    }


}