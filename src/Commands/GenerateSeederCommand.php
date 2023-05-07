<?php
namespace Hzh\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
// use Faker\Factory as FakerFactory;

class GenerateSeederCommand extends Command
{
    protected $signature = 'hzh:seeder {table} {model}';

    protected $description = 'Generate a Seeder file for the specified table.';

    public function handle()
    {
        $tableName = $this->argument('table');
        $modelName = $this->argument('model');
        // $faker = FakerFactory::create();

        $data = DB::table($tableName)->get();

        // $seederData = $data->map(function ($item) use ($faker) {
        //     return (array) $item + ['created_at' => now(), 'updated_at' => now()];
        // });

        $className = studly_case($tableName) . 'Seeder';
        $fileName = $className . '.php';
        $path = database_path('seeders/' . $fileName);

        $template = file_get_contents(__DIR__ . '/../templates/seeder.stub');
        $template = str_replace('{{className}}', $className, $template);
        $template = str_replace('{{modelName}}', $tableName, $template);
        $template = str_replace('{{data}}', var_export($data->toArray(), true), $template);

        file_put_contents($path, $template);

        $this->info("Seeder file {$fileName} generated successfully.");
    }
}
