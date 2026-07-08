<?php

namespace App\Http\Controllers\SuperAdmin\SiteInformation;

use App\Helper\admin\ImageUpload;
use App\Http\Controllers\Controller;
use App\Models\SiteInformationModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteInformationController extends Controller
{
    /*** Information ***/
    public function information()
    {
        $siteInfo = SiteInformationModel::all();
        return view('super_admin.pages.site_info.index',compact('siteInfo'));
    }
    /*** Information Add ***/
    public function information_add()
    {
        $siteInfo = null;
        return view('super_admin.pages.site_info.add',compact('siteInfo'));
    }
    /*** Information Save ***/
    public function information_save(Request $request)
    {
        $msg = [
            'key.required' => 'Please Enter Key.',
            'value.required' => 'Please Enter Value.',
            'image.required' => 'Please Choose An Image.',
        ];
        $infoUpdate = SiteInformationModel::where('id', $request['id'])->first();

        if ($infoUpdate->is_image == 'No') {
            $this->validate($request, [
                'key' => 'required',
                'value' => 'required',
            ], $msg);
        } 
        if ($infoUpdate->is_image == 'Yes') {
            $this->validate($request, [
                'key' => 'required',
                'image' => 'required',
            ], $msg);
        }

        try {
            $path = '/uploads/info/'; // no leading slash

            $imageUpdate = $infoUpdate ? $infoUpdate['value'] : '';

            if ($request->hasFile('image')) {
                $oldImage = $infoUpdate ? $infoUpdate['value'] : null;
                $imageUpdate = ImageUpload::updateImage($oldImage, $path, $request->image);
            }

            // Save or update
            if ($infoUpdate) {
                $infoUpdate->is_image = $infoUpdate['is_image'];

                if ($infoUpdate['is_image'] === 'Yes') {
                    $infoUpdate->value = $imageUpdate;
                } else {
                    $infoUpdate->value = $request['value'];
                }

                $infoUpdate->save();

                return redirect()->back()->with('success', 'Information Updated Successfully!');
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /*** Information Edit ***/
    public function information_edit($id)
    {
        $siteInfo = SiteInformationModel::where('key',$id)->first();
        return view('super_admin.pages.site_info.add',compact('siteInfo'));
    }
}
