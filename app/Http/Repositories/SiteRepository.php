<?php

namespace claymalven\Http\Repositories;

use claymalven\Models\User;
use Crypt;
use Session;
//use claymalven\Sites\WHMCS;
use claymalven\Sites\DomainServices;

class SiteRepository
{
    //protected $site;
    protected $user;
    //protected $whmcs;
    protected $domainServices;

    public function __construct(
        //Site $site, 
        User $user, 
        //WHMCS $whmcs, 
        DomainServices $domainServices)
    {
        //$this->site = $site;
        $this->user = $user;
        //$this->whmcs = $whmcs;
        $this->domainServices = $domainServices;
    }
    //TODO move to a templete controller
    public function copyTemplate($siteType, $templateId, $destionPath)
    {
        $site = $this->getWebsiteInfoFrom($siteType);

        $template = $site['template']::findOrFail($templateId);

        if (!file_exists($destionPath)) {
            mkdir($destionPath, 0755, true);
        }
        foreach (
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator(public_path() . $template->path, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST) as $item
        ) {
            if ($item->isDir()) {
                mkdir($destionPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                copy($item, $destionPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }

    public function addWebsitePages($siteType, $websiteId, $templateId)
    {
        $site = $this->getWebsiteInfoFrom($siteType);

        $templatePages = $site['templatePage']::where($site['templateId'], $templateId)->get();

        foreach($templatePages as $templatePage){
            $page = new $site['websitePage'] ;
            $page->$site['websiteId'] = $websiteId;
            $page->$site['templateId'] = $templateId;
            $page->page_name = $templatePage->page_name;
            $page->path = $templatePage->path;
            $page->save();
        }
    }
    //TODO move to Site Modal
    public function getWebsiteInfoFrom($siteTypeChosenByCustomer)
    {
        $site = [];

        switch ($siteTypeChosenByCustomer) {
            case 'Buying':
                $site['website'] = 'Website';
                $site['websitePage'] = 'WebsitePage';
                $site['template'] = 'Template';
                $site['templatePage'] = 'TemplatePage';
                $site['templateId'] = 'template_id';
                $site['websiteId'] = 'website_id';
                $site['siteTypeField'] = 'buying_website';
                break;
            case 'Selling':
                $site['website'] = 'SellingWebsite';
                $site['websitePage'] = 'SellingPage';
                $site['template'] = 'SellingTemplate';
                $site['templatePage'] = 'SellingTemplatePage';
                $site['templateId'] = 'selling_template_id';
                $site['websiteId'] = 'selling_website_id';
                $site['siteTypeField'] = 'selling_website';
                break;
            case 'Wholesale':
                $site['website'] = 'WholesaleWebsite';
                $site['websitePage'] = 'WholesalePage';
                $site['template'] = 'WholesaleTemplate';
                $site['templatePage'] = 'WholesaleTemplatePage';
                $site['templateId'] = 'wholesale_template_id';
                $site['websiteId'] = 'wholesale_website_id';
                $site['siteTypeField'] = 'wholesale_website';
                break;
            case 'Land':
                $site['website'] = 'LandWebsite';
                $site['websitePage'] = 'LandPage';
                $site['template'] = 'LandTemplate';
                $site['templatePage'] = 'LandTemplatePage';
                $site['templateId'] = 'land_template_id';
                $site['websiteId'] = 'land_website_id';
                $site['siteTypeField'] = 'land_website';
                break;
        }

        return $site;
    }

    public function createWebsite($data)
    {
        $siteInfo = $this->getWebsiteInfoFrom($data['siteType']);

        $website = new $siteInfo['website'];
        $website->user_id = $data['userId'];
        $website->save();

        $this->site->create([
            'website_type' => $data['siteType'],
            $siteInfo['websiteId'] => $website->id,
            'step' => '1',
        ]);

        Session::put('websiteId', $website->id);
        Session::put('websiteType', $data['siteType']);

        return $website->with('site');
    }

    public function removeSite($session)
    {    
        $siteInfo = $this->getWebsiteInfoFrom($session['websiteType']);
        $website = $siteInfo['website']::destroy($session['websiteId']);
        $websitePages = $siteInfo['websitePage']::where($siteInfo['websiteId'], $session['websiteId'])->delete();
    }

    public function updateSite($id, $step)
    {
        $this->site->find($id)->update([
            'step' => $step
        ]);
    }

    public function createWHMCSWebsite($accountNumber, $domainInfo)
    {
        //@TODO check if order fails
        //$order = $this->whmcs->createOrder($accountNumber, 2, $domainInfo);
        //if($order->result != 'success') {
            //dd($order);
        //}

        //$this->whmcs->acceptOrder($order->orderid);

        //return $this->whmcs->getCpanelUsername($order->orderid, $accountNumber);
        return 'user-' . $accountNumber;
    }

    public function getDomaiInfo($domain, $option, $eppCode)
    {
        $domainInfo = [
            'domain' => $fullDomain,
            'domaintype' => $option,
        ];

        if($option == 'transfer'){
            $domainInfo['eppcode'] = $eppCode;
        }

        return $domainInfo;
    }

}
