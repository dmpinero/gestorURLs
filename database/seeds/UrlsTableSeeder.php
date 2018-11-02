<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\URL;

class UrlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run()
    {
        Excel::load('public/excel/urls.xlsx', function($reader) {
            $fila = 0;

            foreach ($reader->get() as $site) {
                $fila++;

                // Obtener información de la url para insertarla en la tabla intermedia
                $url = URL::create([
                    'name' => $site->name,
                    'url' => $site->url,
                    'description' => $site->description
                    ]);

                // Crear una categoría por cada elemento (La , es el token de separación)
                $categorias = explode(',',  $site->categories);
                $id_category = null;
                foreach($categorias as $categoria)
                {
                    //echo "\nCategoria es $categoria";
                    $categoria_bbdd = Category::where('name', '=', $categoria);         
                    // Comprobar si la categoría existe
                    if (! $categoria_bbdd->exists()) {                        
                        //echo "\nNO existe categoria $categoria";
                        $category = Category::create([
                            'name' => $categoria,
                        ]);
                        $id_category = $category->id;
                    }
                    else
                    {
                        $id_category = $categoria_bbdd->first()->id; 
                        //echo "\nSI existe $categoria con identificador $id_category";
                    }
                }

                // Añadir relación en la tabla intermedia
                DB::table('categoriesurls')->insert(
                    [
                        'category_id' => $id_category,
                        'url_id' => $url->id,
                    ]
                );

            } // foreach ($reader->get() as $site)
            
        });

        return URL::all();
    }
}
