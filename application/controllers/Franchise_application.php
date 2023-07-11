<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Franchise_application extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('DepositModel');
    $this->load->model('WithdrawalModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('Referral_bonus_model');
    $this->load->model('Indirect_bonus_model');
    $this->load->model('ReferralModel');
    $this->load->model('Withdrawal_Mode_model');
    $this->load->model('Bank_model');
    $this->load->model('Fund_transfer_model');
    $this->load->model('Fund_bonus_model');
    $this->load->model('Lifestyle_bonus_model');
    $this->load->model('Daily_income_model');
    $this->load->model('Franchise_app_model');

    date_default_timezone_set('Asia/Manila');
  }

  public function index()
  {

    $data['title'] = 'Franchise Application';

    $data['username'] = $this->session->userdata('username');
    $data['email'] = $this->session->userdata('email');
    $data['fullname'] = $this->session->userdata('fullname');
    $data['date_registered'] = $this->session->userdata('date_registered');

    $member = $this->Members->get_member($this->session->username);


    $this->load->view('pages/franchise_application', $data);
  }

  public function show_step_2()
  {
    $data['title'] = 'Franchise Application';

    $data['username'] = $this->session->userdata('username');
    $data['email'] = $this->session->userdata('email');
    $data['fullname'] = $this->session->userdata('fullname');
    $data['date_registered'] = $this->session->userdata('date_registered');

    $this->load->view('pages/franchise_application_2', $data);
  }

  public function submit_application()
  {
    $data['title'] = 'Franchise Application';

    $data['username'] = $this->session->userdata('username');
    $data['email'] = $this->session->userdata('email');
    $data['fullname'] = $this->session->userdata('fullname');
    $data['date_registered'] = $this->session->userdata('date_registered');


    $targetCountry = isset($_POST['country-select']) ? $_POST['country-select'] : "";
    $ownerName = isset($_POST['ownerName']) ? $_POST['ownerName'] : "";
    $ceoName = isset($_POST['ceoName']) ? $_POST['ceoName'] : "";
    $primaryContact = isset($_POST['primaryContact']) ? $_POST['primaryContact'] : "";
    $contactEmail = isset($_POST['contactEmail']) ? $_POST['contactEmail'] : "";
    $companyName = isset($_POST['companyName']) ? $_POST['companyName'] : "";
    $companyTelephone = isset($_POST['companyTelephone']) ? $_POST['companyTelephone'] : "";
    $businessDescription = isset($_POST['businessDescription']) ? $_POST['businessDescription'] : "";
    $businessAddress = isset($_POST['businessAddress']) ? $_POST['businessAddress'] : "";
    $groceryOutletQuantity = isset($_POST['groceryOutletQuantity']) ? $_POST['groceryOutletQuantity'] : "";
    $retailOutletsQuantity = isset($_POST['retailOutletsQuantity']) ? $_POST['retailOutletsQuantity'] : "";


    $typeConvenience = isset($_POST['typeConvenience']) ? $_POST['typeConvenience'] : "";
    $typeHypermarket = isset($_POST['typeHypermarket']) ? $_POST['typeHypermarket'] : "";
    $typeLargerSupermarket = isset($_POST['typeLargerSupermarket']) ? $_POST['typeLargerSupermarket'] : "";
    $typePetrolStore = isset($_POST['typePetrolStore']) ? $_POST['typePetrolStore'] : "";
    $typeNeighborhoodSupermarket = isset($_POST['typeNeighborhoodSupermarket']) ? $_POST['typeNeighborhoodSupermarket'] : "";


    $typeOfOutlet = " ";
    $typeOfOutlet .= ($typeConvenience == 1) ? ", Convenience stores" : "";
    $typeOfOutlet .= ($typeHypermarket == 1) ? ", Hypermarkets" : "";
    $typeOfOutlet .= ($typeLargerSupermarket == 1) ? ", Large supermarkets" : "";
    $typeOfOutlet .= ($typePetrolStore == 1) ? ", Petrol forecourt stores" : "";
    $typeOfOutlet .= ($typeNeighborhoodSupermarket == 1) ? ", Neighborhood supermarkets" : "";


    $locationUrbanResidential = isset($_POST['locationUrbanResidential']) ? $_POST['locationUrbanResidential'] : "";
    $locationUrbanCity = isset($_POST['locationUrbanCity']) ? $_POST['locationUrbanCity'] : "";
    $locationRuralVillage = isset($_POST['locationRuralVillage']) ? $_POST['locationRuralVillage'] : "";
    $locationRuralResidential = isset($_POST['locationRuralResidential']) ? $_POST['locationRuralResidential'] : "";
    $locationAirport = isset($_POST['locationAirport']) ? $_POST['locationAirport'] : "";
    $locationRailway = isset($_POST['locationRailway']) ? $_POST['locationRailway'] : "";
    $locationHarbours = isset($_POST['locationHarbours']) ? $_POST['locationHarbours'] : "";
    $locationIndustrial = isset($_POST['locationIndustrial']) ? $_POST['locationIndustrial'] : "";
    $locationOther = isset($_POST['locationOther']) ? $_POST['locationOther'] : "";


    $currentLocations = " ";
    $currentLocations .= ($locationUrbanResidential == 1) ? ", Urban residential areas" : "";
    $currentLocations .= ($locationUrbanCity == 1) ? ", Urban residential areas" : "";
    $currentLocations .= ($locationRuralVillage == 1) ? ", Rural village centres" : "";
    $currentLocations .= ($locationRuralResidential == 1) ? ", Rural residential Areas" : "";
    $currentLocations .= ($locationAirport == 1) ? ", Airports" : "";
    $currentLocations .= ($locationRailway == 1) ? ", Railway stations" : "";
    $currentLocations .= ($locationHarbours == 1) ? ", Harbours" : "";
    $currentLocations .= ($locationIndustrial == 1) ? ", Industrial, Office estates" : "";
    $currentLocations .= ($locationOther == 1) ? ", Other" : "";

    $totalAnnualTurnover = $_POST['totalAnnualTurnover'];
    $averageSales = $_POST['averageSales'];
    $annualGroceryTurnover = $_POST['annualGroceryTurnover'];
    $distributionCenterQuantity = $_POST['distributionCenterQuantity'];

    $reasonForJoining = $_POST['reasonForJoining'];

    $sourceNewspaper = isset($_POST['sourceNewspaper']) ? $_POST['sourceNewspaper'] : "";
    $sourceTvAd = isset($_POST['sourceTvAd']) ? $_POST['sourceTvAd'] : "";
    $sourceOnlineAd = isset($_POST['sourceOnlineAd']) ? $_POST['sourceOnlineAd'] : "";
    $sourcePress = isset($_POST['sourcePress']) ? $_POST['sourcePress'] : "";
    $sourceMagazines = isset($_POST['sourceMagazines']) ? $_POST['sourceMagazines'] : "";
    $sourceNewsletter = isset($_POST['sourceNewsletter']) ? $_POST['sourceNewsletter'] : "";
    $sourceConference = isset($_POST['sourceConference']) ? $_POST['sourceConference'] : "";
    $sourceBranded = isset($_POST['sourceBranded']) ? $_POST['sourceBranded'] : "";
    $sourceInternational = isset($_POST['sourceInternational']) ? $_POST['sourceInternational'] : "";
    $sourceOther = isset($_POST['sourceOther']) ? $_POST['sourceOther'] : "";

    $sources = " ";
    $sources .= ($sourceNewspaper == 1) ? ", News paper" : "";
    $sources .= ($sourceTvAd == 1) ? ", TV advertisement" : "";
    $sources .= ($sourceOnlineAd == 1) ? ", Online advertisement" : "";
    $sources .= ($sourcePress == 1) ? ", Press releases" : "";
    $sources .= ($sourceMagazines == 1) ? ", Trade magazines" : "";
    $sources .= ($sourceNewsletter == 1) ? ", Newsletters" : "";
    $sources .= ($sourceConference == 1) ? ", International Conference" : "";
    $sources .= ($sourceBranded == 1) ? ", SPAR branded website" : "";
    $sources .= ($sourceInternational == 1) ? ", SPAR international website" : "";
    $sources .= ($sourceOther == 1) ? ", Other" : "";

    $franchise_application_entry = $data["fullname"] . "\n" .
      "PERSONAL INFORMATION \n" .
      "Target country: " . $targetCountry . "\n" .
      "Name of owner: " . $ownerName . "\n" .
      "Name of CEO/Managing Director: " . $ceoName . "\n" .
      "Name of primary contact person: " . $primaryContact . "\n" .
      "Email address primary contact: " . $contactEmail . "\n\n" .

      "CORPORATE DETAILS \n" .
      "Name of the company: " . $companyName . "\n" .
      "Telephone: " . $companyTelephone . "\n" .
      "General description of your business activities: " . $businessDescription . "\n" .
      "Address: " . $businessAddress . "\n" .
      "How many company owned grocery outlets do you have?: " . $groceryOutletQuantity . "\n" .
      "How many other company owned retail outlets do you have?: " . $retailOutletsQuantity . "\n" .
      "Which type of grocery retail outlets do you have?: " . $typeOfOutlet . "\n" .
      "Where are your stores located?: " . $currentLocations . "\n" .
      "What is the total annual turnover of the total company?: " . $totalAnnualTurnover . "\n" .
      "What is the average size of the sales area in your stores?: " . $averageSales . "\n" .
      "What is the annual grocery retail turnover of your company?: " . $annualGroceryTurnover . "\n" .
      "How many Distribution Centres does the company own?: " . $distributionCenterQuantity . "\n\n" .

      "ABOUT SPAR \n" .
      "Why do you want to join SPAR?: " . $reasonForJoining . "\n" .
      "Where did you first hear about SPAR?: " . $sources . "\n";

    $this->load->library('email');

    $this->email->from('administrator@spar-investordashboard.com', 'SPAR Franchisee')
      ->to('administrator@spar-investordashboard.com')
      ->subject($data['fullname'] . " - Franchise Application")
      ->message($franchise_application_entry);

    if ($this->email->send(false)) {
      $this->session->set_flashdata('application_sent', "sent");
    }

    $app_entry['entry'] = $franchise_application_entry;
    $this->Franchise_app_model->add($app_entry);

    redirect('franchise_application', 'refresh');
  }
}