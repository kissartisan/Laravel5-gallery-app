<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The database table used by the model
     */
    protected $table = 'gallery';

    public function images()
    {
    	return $this->hasMany('App\Image');
    }
}
