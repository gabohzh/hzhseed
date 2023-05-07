<?php

namespace Hzh\Seeder\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateSeederCommand extends Command
{
    protected $name = 'Seeder Generator';
    protected $signature = 'hzh:seeder {table} {model}';
    protected $description = 'Generate a Seeder file for the specified table from current database.';
    protected $help = 'You can generate a Seeder file for the specified table in your current database';

    public function handle()
    {
        $tableName = $this->argument('table');
        $modelName = $this->argument('model');
        $modelClass = "App\Models\\" . $modelName;
        $data = $modelClass::all();

        $current_date = date('Y-m-d H:i:s');

        foreach ($data as $row) {
            $row['created_at'] = $current_date;
            $row['updated_at'] = $current_date;
        }
        $className = Str::studly($tableName) . 'Seeder';
        $fileName = $className . '.php';
        $path = database_path('seeders/' . $fileName);
        $template = file_get_contents(__DIR__ . '/../../stubs/seeders/seeder.stub');
        $template = str_replace('{{className}}', $className, $template);
        $template = str_replace('{{modelName}}', $modelName, $template);
        $template = str_replace('{{data}}', var_export($data->toArray(), true), $template);

        file_put_contents($path, $template);

        $this->info("Seeder file {$fileName} generated successfully.");
    }
}
