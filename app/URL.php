<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'urls';
    
    // Categorías de una URL
    public function categorias()
    { 
        return $this->belongsToMany('App\Category', 'category_urls', 'category_id', 'url_id');
    } 
}
