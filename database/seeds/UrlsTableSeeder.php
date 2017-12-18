<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\URL;

class UrlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::load('public/excel/urls.xlsx', function($reader) {
            $fila = 0;
            //$image_directory = "public/url_images/";

            //echo "borrando $image_directory";
            //Storage::deleteDirectory($image_directory);
            //echo "borrado directorio";

            // Borrar imágenes ya almacenadas
            //Storage::delete(Storage::allFiles($image_directory));

            foreach ($reader->get() as $site) {
                $fila++;

                // Guardar captura de imagen de la URL
                $nombre_imagen = "$fila _" . date('YmdHis') . ".jpg";
                $nombre_imagen = $site->name ? $site->name != "" : date('YmdHis');
                echo "\nGenerando imagen $fila para $site->url";
                /*Browsershot::url($site->url)
                    ->windowSize(1920, 1080)
                    ->fit(Manipulations::FIT_CONTAIN, 1920, 1080)
                    ->save($image_directory . $nombre_imagen);
                */
                $url = URL::create([
                    'name' => $site->name,
                    'url' => $site->url,
                    'description' => $site->description,
                    //'image_name' => $nombre_imagen,
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
