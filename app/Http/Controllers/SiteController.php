<?php

namespace claymalven\Http\Controllers;

use claymalven\Http\Traits\SelectList;

use claymalven\Sites\DomainServices;
use claymalven\Sites\CpanelApi;
use claymalven\Http\Repositories\SiteRepository;
use claymalven\Http\Controllers\Controller;
use claymalven\Models\User;
use claymalven\Models\Website;
use claymalven\Models\Template;
use Auth;
use Session;

class SiteController extends Controller
{

    use SelectList;

    protected $user;
    protected $setup;

    private static $siteTypes = ["Buying","Selling","Wholesale","Land"];

    public function __construct(User $user, DomainServices $domainServices, SiteRepository $setup)
    {
        $this->user = $user;
        $this->setup = $setup;
        $this->domainServices = $domainServices;
    }

    public function index()
    {
        if (Session::has('siteId')) {
            $progressId = Session::get('siteId');
            $userSite = Site::whereUserId(Auth::id())->whereId($progressId)->first();
            if (!$userSite) {
                // @TODO return a message with redirect
                return Redirect::to('/dashboard');
            }
        }

        return View::make('new-website.index');
    }
    //TODO validate
    public function store()
    {
        $site = Site::create(Input::all());
        Session::put('siteId', $site->id);

        return $site;
    }
    //TODO validate
    public function update($id)
    {
        $data = Input::get('data');
        $site = Site::findOrFail($id);
        $site->update($data);

        return $site;
    }
    //TODO move to a DomanController
    public function getRequestedDomainStatus($domain)
    {
        $availabilityResponse = $this->domainServices->checkDomainAvailability($domain);

        return Response::json($availabilityResponse);
    }
    //TODO move to a DomanController
    public function getDomainSuggestions()
    {
        if ( !Input::has('name') && !Input::has('city')) {
            return Response::json(array('error' => 'Both fields are required.'));
        }

        $name = $this->domainServices->stripSpacesAndMakeLowercase(Input::get('name'));
        $city = $this->domainServices->stripSpacesAndMakeLowercase(Input::get('city'));
        $suggestions = $this->domainServices->returnDomainSuggestions($name, $city);

        return Response::json(['domains' => $suggestions]);
    }
    //TODO move to a TemplateController
    public function getAllTemplates(){
        return Template::all();
    }
    //TODO change name to syncData
    public function startCreateWebsiteApp()
    {
        $start['User'] = Auth::user();
        //$start['Site'] = new Site();
        $start['Website'] = new Website();
        $start['Template'] = new Template();

        if(!Session::has('siteId')) {
            return response()->json($start);
        }

        if($site = Site::find(Session::get('siteId'))){
            $siteInfo = $this->setup->getWebsiteInfoFrom($site->website_type);
            if(isset($site->all_template_id)){
                $start['Template'] = AllTemplate::find($site->all_template_id);
            }
            if(isset($site->website_id)){
                $class = $site->website_type;
                $start['Website'] = $siteInfo['website']::find($site->website_id);
            }
        }
        $start['Site'] = $site;
        
        
        return Response::json($start);
    }
    //@TODO rewrite and break down into smaller methods
    public function addSite()
    {
        $data = Input::all();
        //dd($data);
        $fullDomain = $data['domain'].$data['tld'];
        $validator = Validator::make($data,[
            'user_id' => 'required|integer',
            'all_template_id' => 'required|integer',
            'color_scheme_id' => 'integer',
            'email_for_leads' => 'email',
            'autoresponder_from' => 'string',
            'autoresponder_from_email' => 'email',
            'global_email' => 'email',
            'target_city' => 'string',
            'business_address' => 'string',
            'business_city' => 'string',
            'business_state' => 'string',
            'business_zip' => 'alpha_num',
            'office_phone' => 'alpha_dash',
            'office_fax' => 'aplha_dash',
            'map_center_city' => 'string',
            'map_center_state' => 'string'
        ]);

        if ($validator->fails()) {
            return Response::json($validator->messages());
        }

        $user = Auth::user();

        $siteInfo = $this->setup->getWebsiteInfoFrom($data['website_type']);
        //TODO find better way to create a website
        $website = new $siteInfo['website'];

        $website->user_id = $user->id;
        $website->template_id = $data['all_template_id'];
        $website->color_scheme_id = 1;
        $website->email_for_leads = $user->email;
        $website->autoresponder_from = $user->getUserFullName();
        $website->autoresponder_from_email = $user->email;
        $website->global_email = $user->email;
        $website->domain_name = $fullDomain;
        $website->target_city = $user->city;
        $website->target_state = $user->state;
        $website->business_address = $user->address;
        $website->business_city = $user->city;
        $website->business_state = $user->state;
        $website->business_zip = $user->zip_code;
        $website->office_phone = $user->phone_number;
        $website->office_fax = null;

        if ($data['website_type'] === 'Selling' || $data['website_type'] === 'Wholesale') {
            $website->map_center_city = $user->city;
            $website->map_center_state = $user->state;
        }

        $website->save();

        $this->setup->addWebsitePages($data['website_type'], $website->id, $data['all_template_id']);

        $domainInfo = $this->setup->getDomaiInfo($fullDomain, $data['domain_option'], $data['epp_code']);

        $cpanel_user = $this->setup->createWHMCSWebsite($user->account_number, $domainInfo);

        $destionPath = 'sites/' . $cpanel_user .'/'. strtolower($data['website_type']) . '/' . $cpanel_user . '/' . $data['all_template_id'].'/';

        $this->setup->copyTemplate($data['website_type'], $data['all_template_id'], $destionPath);

        

        $website->cpanel_user = $cpanel_user;
        $website->path = '/'.$destionPath;
        $website->save();

        return Response::json([
            'success' => "The user with an id of $userId has successfully created a website.",
            'website' => $website
        ]);
    }
    //TODO Look in to why company name is not saving
    //TODO validate on  the back end
    //TODO create a repo  function to clean up code
    public function postBusinessInfo()
    {
        // validate
        // write to db
        $websiteData  = Input::only(
            'business_address',
            'business_city',
            'business_state',
            'business_zip',
            'office_phone',
            'autoresponder_from',
            'office_fax',
            'email_for_leads',
            'id',
            'site_type'
        );

        $userData = Input::only(
            'company_name',
            'user_id'
        );

        $websiteData['site_type'] === 'Buying' ? $siteType = 'Website' : $siteType = $websiteData['site_type'].'Website';

        $website = $siteType::findOrFail($websiteData['id']);
        $user = $this->user->find($userData['user_id']);
        $websiteData['autoresponder_from'] = $websiteData['autoresponder_from'];
        $user->company_name = $userData['company_name'];
        $user->save();
        $website->update([
            'office_phone' => $websiteData['office_phone'],
            'office_fax' => $websiteData['office_fax'],
            'global_phone' => $user->phone_number,
            'autoresponder_from' => $websiteData['autoresponder_from'],
            'phone_for_leads' => $user->phone_number,
            'business_city' => $websiteData['business_city'],
            'business_state' => $websiteData['business_state'],
            'business_zip' => $websiteData['business_zip']
        ]);

        // write to whmcs
        return Response::json(['success'=> 'you have successfully updated your information']);
    }
    //TODO seem like this could use some work
    public function postBusinessInfoLogo()
    {
        $logo = Input::file('file');
        $data = Input::only('site_type','website_id');
        $type = null;
        $data['site_type'] == 'Buying' ? $type = 'Website' : $type = $data['site_type'].'Website';
        $website = $type::find($data['website_id']);
        $imageDirectory = public_path().$website->path.'images/';
        $result = $logo->move($imageDirectory,$logo->getClientOriginalName());
        return Response::json(['success'=>'image successfully uploaded']);
    }
    //TODO needs work
    public function setSession($key, $value)
    {
        if(!$key || !$value){
            return Response::json(['error' => true]);
        }
        Session::put($key, $value);
        return Response::json(['success' => true]);
    }
}
