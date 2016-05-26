<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['gallery_id', 'file_name', 'file_size', 'file_mime', 'file_path', 'created_by'];

    # Set the relationship of the image and the gallery on the model
    public function gallery()
    {
    	return $this->belongsTo('App\Gallery');
    }
}
