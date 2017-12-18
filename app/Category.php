<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
         // URLs de una categoría
         public function urls()
         { 
             return $this->belongsToMany('App\URL', 'category_urls', 'category_id', 'url_id');
         }     
}
