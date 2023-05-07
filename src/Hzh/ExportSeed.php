<?php

namespace Hzh;

use Illuminate\Support\Facades\Artisan;

class ExportSeed
{
    public static function exportar($tabla, $modelo)
    {
        // Nombre del archivo seed a crear
        $archivo = database_path('seeds/' . $tabla . 'Seeder.php');

        // Recuperar los datos de la tabla de la base de datos
        $datos = $modelo::all();

        // Convertir los datos a formato JSON
        $datos_json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // Contenido del archivo de seed
        $contenido = <<<EOT
<?php

use Illuminate\Database\Seeder;

class {$tabla}Seeder extends Seeder
{
    public function run()
    {
        \$datos = {$datos_json};
        {$tabla}::insert(\$datos);
    }
}
EOT;

        // Crear el archivo de seed y escribir el contenido en él
        file_put_contents($archivo, $contenido);

        // Ejecutar el comando para agregar los datos a la base de datos de Laravel
        //Artisan::call('db:seed', ['--class' => $tabla . 'Seeder']);
    }
}
