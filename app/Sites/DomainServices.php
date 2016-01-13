<?php 

namespace claymalven\Sites;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class DomainServices {

    protected $apiKey;
    protected $searchType;

    public function __construct()
    {
        // $this->config = Config::get('DomainServices');
        // $this->apiKey = $this->config['apiKey'];
        // $this->searchType = 'nxd';

        //$this->search = new Search('nxd',$this->apiKey);
    }

    public function checkDomainAvailability($domain)
    {
      // $requestAvailabilty = new Whois($domain);
      // $execute = $requestAvailabilty->isAvailable();

      // return $execute;
    }

    private function checkMultipleDomainsAvailability($domains)
    {
      // foreach ($domains as $key => $domain) {
      //   $domains[$key] = [
      //     'domain' => $domain,
      //     'available' => $this->checkDomainAvailability($domain)
      //   ];
      // }

      // return $domains;
    }

    public function returnDomainSuggestions($name,$city)
    {

      $suggestedDomains = [
        ["domain" => "webuy".$city."houses", 'tld' => '.com', 'check' => false, 'available' => ''],
        ["domain" => "webuy".$city."homes", 'tld' => '.com', 'check' => false, 'available' => ''],
        ["domain" => "ibuy".$city."homes", 'tld' => '.com', 'check' => false, 'available' => ''],
        ["domain" => $name."buys".$city."housescash", 'tld' => '.com', 'check' => false, 'available' => ''],
        ["domain" => "ibuy".$city."houses", 'tld' => '.com', 'check' => false, 'available' => ''],
        ["domain" => "webuy".$city."homescash", 'tld' => '.com', 'check' => false, 'available' => ''],
        ["domain" => $name."buys".$city."homescash", 'tld' => '.com', 'check' => false, 'available' => ''],
        ["domain" => $name."buyshomescash", 'tld' => '.com', 'check' => false, 'available' => ''],
        ["domain" => $name."buyshousescash", 'tld' => '.com', 'check' => false, 'available' => ''],
      ];

      //$suggestions = $this->checkMultipleDomainsAvailability($suggestedDomains);

        return (object) $suggestedDomains;
    }

    public function stripSpacesAndMakeLowercase($string)
    {
        return str_replace(' ','',strtolower($string));
    }
}
