<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInformationModel extends Model
{
    use HasFactory;
    protected $table = 'site_info';

    public function getImageUrlAttribute()
    {
        return $this->value ? asset('/data/public/uploads/info/' . $this->value) : null;
    }

}
