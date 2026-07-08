<?php


namespace App\Helper\admin;
use App\Models\SiteInformationModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class siteInformation
{
    /*** Site Info ***/
    public static function siteInfo()
    {
        $info['site_name'] = SiteInformationModel::where('key','site_name')->value('value');
        $info['site_logo'] = SiteInformationModel::where('key','site_logo')->value('value');
        $info['footer_logo'] = SiteInformationModel::where('key','footer_logo')->value('value');
        $info['favicon'] = SiteInformationModel::where('key','favicon')->value('value');
        $info['phone'] = SiteInformationModel::where('key','phone')->value('value');
        $info['whatsapp'] = SiteInformationModel::where('key','whatsapp')->value('value');
        $info['email'] = SiteInformationModel::where('key','email')->value('value');
        $info['address'] = SiteInformationModel::where('key','address')->value('value');
        $info['copyright'] = SiteInformationModel::where('key','copyright')->value('value');
        $info['footer_text'] = SiteInformationModel::where('key','footer_text')->value('value');
        $info['footer_text2'] = SiteInformationModel::where('key','footer_text2')->value('value');

        self::configDetails($info);
        return $info;
    }

    /*** Config Details Set ***/
    public static function configDetails($info)
    {
       Config::set('app.name',$info['site_name']);
    }

    /*** Clear Cache ***/
    public static function clearCache()
    {
        Artisan::call('cache:clear');
        // clear route cache
        Artisan::call('route:clear');
        // clear view compiled files
        Artisan::call('view:clear');
        // clear config files
        Artisan::call('config:clear');
        return 'Clear Successfull';
    }
}
