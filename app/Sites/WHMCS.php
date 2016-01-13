<?php

namespace claymalven\Sites;

use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\App;
use claymalven\Http\SelectList;


/*
 *
 *
 *
 * The trick to getting the WHMCS to save the clients payment information to the CIM
 * is to create an order with a payment gateway set, then update the clients information
 * with payment information.  Any other order of events breaks the client ability to update
 * the client information
 *
 *
 */
class WHMCS {

    use SelectList;

    protected $config;
    protected $api;

    public $client_form_adaptor = [
        'firstname' => 'first_name',
        'lastname' => 'last_name',
        'email' => 'email',
        'address1' => 'address',
        'address2' => 'address_line_2',
        'city' => 'city',
        'state' => 'state',
        'postcode' => 'zip_code',
        'country' => 'country_code',
        'phonenumber' => 'phone_number',
        'password2' => 'password'
    ];

    public $client_payment = [
        'cardtype' => 'card_type',
        'cardnum' => 'card_number',
        'expdate' => ['expiration_month', 'expiration_year']
    ];

    /**
     * update $rules when product id's change
     *
     * @var array
     */
    public $API_PRODUCT_ACCESS = [1, 2, 3, 4, 5, 6];
    public $API_GROUP_ACCESS = [1, 3, 4, 5, 6];

    public function __construct()
    {
        $this->config = Config::get('WHMCS');
        $this->api = new Client();
    }

    public function findProductOrFail($productId)
    {
        if(! in_array($productId, $this->API_PRODUCT_ACCESS)) App::abort(404);

        $products = $this->getProducts();

        foreach ($products as $product)
        {
            if( $product->pid == $productId)
            {
                if ( ! in_array($product->gid, $this->API_GROUP_ACCESS)) App::abort(404);
                $product = $this->addDisplayPrice($product);

                return $product;
            }
        }

        App::abort(404);
    }

    public function addClient($formInput)
    {
        $postFields = $this->makePostFields(array_merge([
            'action' => 'addclient',
            'noemail' => 'true',
        ], $formInput));

        return $this->processPostRequest($postFields);
    }

    public function deleteClient($clientId)
    {
        $postFields = $this->makePostFields([
            'action' => 'deleteclient',
            'clientid' => $clientId
        ]);

        return $this->processPostRequest($postFields);
    }

    public function updateClient($clientId, $formInput)
    {
        $postFields = $this->makePostFields(array_merge([
            'action' => 'updateclient',
            'clientid' => $clientId
        ], $formInput));

        return $this->processPostRequest($postFields);
    }

    public function updatePayment($clientId, $formInput)
    {
        $inputDate = $this->processFieldAdaptor($formInput, $this->client_payment);

        return $this->updateClient(
            $clientId,
            array_merge($inputDate, ['paymentmethod' => $this->config['paymentmethod']])
        );
    }

    public function createOrder($clientId, $pid, $formInput = [])
    {
        $postFields = $this->makePostFields(array_merge([
            'action' => 'addorder',
            'clientid' => $clientId,
            'pid' => $pid,
            'noemail' => 'true',
            'noinvoiceemail' => 'true',
            'billingcycle' => 'monthly',
            'paymentmethod' => $this->config['paymentmethod']
        ], $formInput));

        return $this->processPostRequest($postFields);
    }

    public function createWebsiteOrder($clientId, $pid, $formInput = [])
    {
        $postFields = $this->makePostFields(array_merge([
            'action' => 'addorder',
            'clientid' => $clientId,
            'pid' => $pid,
            'noemail' => 'false',
            'paymentmethod' => $this->config['paymentmethod']
        ], $formInput));

        return $this->processPostRequest($postFields);
    }

    /*
     * Not sure if this works.... renamed it to create invoice
     *
     *
     */
    public function createInvoice($clientId, $orderItems){

        $postFields = $this->makePostFields(array_merge([
            'action' => 'createinvoice',
            'userid' => $clientId,
            'paymentmethod' => $this->config['paymentmethod'],
            'sendinvoice' => 'false',
        ], $orderItems));

        return $this->processPostRequest($postFields);
    }

    public function capturePayment($invoiceId, $cvv)
    {
        $post_fields = $this->makePostFields([
            'action' => 'capturepayment',
            'noemail' => 'true',
            'invoiceid' => $invoiceId,
            'cvv' => $cvv
        ]);

        return $this->processPostRequest($post_fields);
    }

    public function acceptOrder($orderId)
    {
        $postFields = $this->makePostFields([
            'action' => 'acceptorder',
            'orderid' => $orderId,
            'autosetup' => 'false',
            'sendemail' => 'false',
        ]);

        return $this->processPostRequest($postFields);
    }

    public function deleteOrder($orderId)
    {
        $postFields = $this->makePostFields([
            'action' => 'deleteorder',
            'orderid' => $orderId,
        ]);

        return $this->processPostRequest($postFields);
    }

    public function getOrder($orderId)
    {
        $postFields = $this->makePostFields([
            'action' => 'getorders',
            'id' => $orderId,
        ]);

        return $this->processPostRequest($postFields);
    }

    public function getClientDetails($clientId)
    {
        return $this->processPostRequest($this->makePostFields([
            'action' => 'getclientsdetails',
            'clientid' => $clientId
        ]));
    }

    public function checkEmail($email)
    {
        $response = $this->processPostRequest($this->makePostFields([
            'action' => 'getclientsdetails',
            'email' => $email
        ]));
        if($response->result === "success"){
            return true;
        }
        return false;
    }

    public function getCpanelUsername($orderId, $clientId)
    {
        $client = $this->getClientProducts($clientId);

        foreach($client->products->product as $product) {
            if($product->orderid == $orderId)
                return $product->username;
        }
    }

    public function getClientProducts($clientId)
    {
        return $this->processPostRequest($this->makePostFields([
            'action' => 'getclientsproducts',
            'clientid' => $clientId
        ]));
    }

    public function updateClientProduct($orderId, $pid, $formInput)
    {
        $postFields = $this->makePostFields(array_merge([
            'action' => 'updateclientproduct',
            'serviceid' => $orderId,
            'pid' => $pid,
        ], $formInput));

        return $this->processPostRequest($postFields);
    }

    public function domainRegister($domainId)
    {
        return $this->processPostRequest($this->makePostFields([
            'action' => 'domainregister',
            'domainid' => $domainId
        ]));
    }

    public function getPaymentMethods()
    {
        return $this->processPostRequest($this->makePostFields([
            'action' => 'getpaymentmethods'
        ]));
    }

    public function getProducts()
    {
        $reply =  $this->processPostRequest($this->makePostFields([
            'action' => 'getproducts'
        ]));

        return $reply->products->product;
    }

    public function makeAutoAuthUrl($userEmail, $goToCartUrl = null)
    {
        $timeStamp = time();
        $hash = sha1($userEmail . $timeStamp . $this->config['username']);
        $parameters = ['email' => $userEmail, 'timestamp' => $timeStamp, 'hash' => $hash];
        if(!is_null($goToCartUrl)) $parameters['goto'] = urlencode($goToCartUrl);
        $url =  $this->config['auto_auth_url'] . "?" . $this->joinUrlParameters($parameters);

        return $url;
    }

    public function makeCartUrl($productId, $template)
    {
        return "cart.php?a=add&" . $this->joinUrlParameters(['pid' => $productId, 'cartpl' => $template]);
    }

    private function joinUrlParameters($parameterArray)
    {
        $tempArray = [];
        foreach( $parameterArray as $query => $value)
        {
            $tempArray[] = $query . "=" . $value;
        }

        return implode("&", $tempArray);
    }

    public function processPostRequest($postFields)
    {
        try {
            $response = $this->api->post($this->config['url'], $postFields);
            $reply = json_decode( $response->getBody()->getContents() );
        } catch (ClientException $exception) {
            $reply = $exception->getResponse();
        }

        return $reply;
    }

    private function makePostFields($query)
    {
        $authorizationVariables = [
            'username' => $this->config['username'],
            'password' => $this->config['password'],
            'responsetype' => $this->config['responsetype'],
        ];
        $allFields = array_merge($authorizationVariables, $query);

        return ['body' => $allFields];
    }

    /*
     * TODO fix to non monthly costs
     */
    private function addDisplayPrice($product)
    {
        $pricing = $product->pricing->{$this->config['currency']};
        $pre = $pricing->prefix;
        $monthly = $pricing->monthly;
        $display = $pre . $monthly . ' / month';
        $product->displayCost = $display;

        return $product;
    }

    public function createClientFromForm($formInput)
    {
        return $this->addClient($this->processFieldAdaptor($formInput, $this->client_form_adaptor));
    }

    /*
     * This needs work...
     */
    public function processFieldAdaptor($input, $adaptor)
    {
        $whmcsFields = [];
        foreach($adaptor as $whmcsField => $formField){
            $inputValue = '';
            if(is_array($formField)){
                foreach($formField as $fieldArrayValue){
                    $inputValue .= $input[$fieldArrayValue];
                }
            } else {
                $inputValue = $input[$formField];
            }
            $whmcsFields[$whmcsField] = $inputValue;
        }

        return $whmcsFields;
    }

    public $rules = [
        'pid'                   => 'in:1,2,3,4,5,6',
        'first_name'         	=> 'required|max:50',
        'last_name'      	    => 'required|max:50',
        'email'      	    	=> 'required|email|max:100|unique:users,email',
        'password'      		=> 'required|confirmed',
        'password_confirmation' => 'required',
        'phone_number'          => 'required|max:20',
        'address'               => 'required|max:175',
        'state'      		    => 'required|max:30',
        'city'      	     	=> 'required|max:30',
        'zip_code'      	    => 'required|max:10',
        'country_code'      	=> 'required',
        'name_on_card'          => 'required',
        'card_number'           => 'required',
        'expiration_month'      => 'required',
        'expiration_year'       => 'required',
        'card_type'             => 'required',
        'card_cvv'              => 'required',
    ];

    public $domainSetupRules = [
        'chosen_domain' => 'required',
        'chosen_template' => 'required',
    ];
}
