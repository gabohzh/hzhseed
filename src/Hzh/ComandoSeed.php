<?php

namespace Hzh;
use Illuminate\Console\Command;

class ComandoSeed extends Command
{
    protected $signature = 'hzh {param}';

    protected $description = 'Crea un seeder a partir de una tabla de bdd';

    public function configure()
    {
        $this->setDescription('Crea un seeder a partir de una tabla de base de datos bdd')
             ->setHelp('Ingresa la tabla y el modelo')
             ->addArgument('table', InputArgument::REQUIRED, 'Table from bdd')
             ->addArgument('model', InputArgument::REQUIRED, 'model name');
    }

    public function handle()
    {
        $myClass = new ExportSeed();
        $result = $myClass->exportar($this->argument('table'), $this->argument('model'));
        $this->info($result);
    }
}
