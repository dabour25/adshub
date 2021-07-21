<?php

namespace App\Requests\Ads;

use App\Requests\BaseRequestForm;

class CreateAdValidator extends BaseRequestForm
{
    
    public function rules(): array
    {
        $type=$this->request()->get('ad_type');
        if($type=='image'){
            return [
                'title' => 'required|min:5|max:50',
                'total_cost' => 'required|numeric|min:3|max:99999',
                'max_time' => 'required|numeric|min:3|max:30',
                'link'=>'nullable|min:5|max:500|url',
                'ad_view'=>'required|image|max:8192',
            ];
        }elseif($type=='page'){
            return [
                'title' => 'required|min:5|max:50',
                'total_cost' => 'required|numeric|min:3|max:99999',
                'max_time' => 'required|numeric|min:3|max:40',
                'ad_view'=>'required|url|min:5|max:500',
            ];
        }elseif($type=='youtube'){
            return [
                'title' => 'required|min:5|max:50',
                'total_cost' => 'required|numeric|min:3|max:99999',
                'max_time' => 'required|numeric|min:10|max:180',
                'link'=>'nullable|min:5|max:500|url',
                'ad_view'=>'required|url|min:5|max:500',
            ];
        }
    }

    public function authorized(): bool
    {
       return true;
    }
}
