<?php

namespace Database\Seeders;

use App\Models\SiteInformationModel;
use Illuminate\Database\Seeder;

class SiteInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $key = ['site_name','site_logo','favicon','copyright','phone','email','whatsapp','address',
            'footer_logo','footer_text'];
        $title = ['Site Name','Site Logo','Favicon','Copyright','Phone','Email','WhatsApp','Address',
            'Footer Logo','Footer Text'];
        $isImage = ['No','Yes','Yes','No','No','No','No','No','Yes','No'];
        $value = ['Test Admin','logo.png',
            'favicon.png',
            'Copyright © 2026 Sembark Tech. All rights reserved.','0000000000','info@gmail.com','0000000000',
            'Test Address, India','logo.png','Footer Text'];
        if (!empty($key)){
            SiteInformationModel::truncate();
            for ($t=0;$t<count($key);$t++){
                $save = new SiteInformationModel();
                $save->key = $key[$t];
                $save->title = $title[$t];
                $save->is_image = $isImage[$t];
                $save->value = $value[$t];
                $save->save();
            }
        }
    }
}
