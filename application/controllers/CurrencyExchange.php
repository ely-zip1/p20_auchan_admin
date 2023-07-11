<?php
class CurrencyExchange extends CI_Controller
{
	public function __construct()
        {
            parent::__construct();
            $this->load->model('Forex_model');
        }

	public function index()
	{
        $currencies = file_get_contents('https://api.currencyfreaks.com/v2.0/rates/latest?apikey=bddfe5b54bdb4bb2a60dedf37b09cc63');

        $the_json = json_decode($currencies);

        echo $the_json->rates->PHP;

        $data = array(
            'rate' => $the_json->rates->PHP,
            'date' => date("Y-m-d H:i:s")
        );

        $this->Forex_model->add($data);
    }


}