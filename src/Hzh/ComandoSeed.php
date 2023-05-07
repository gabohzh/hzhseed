<?php

namespace Hzh;

use Symfony\Component\Console\Command\Command;

class MyCommand extends Command
{
    protected $signature = 'hzh {param}';

    protected $description = 'Crea un seed a partir de una tabla de bdd';

    public function configure()
    {
        $this->setDescription('Crea un seed a partir de una tabla de base de datos bdd')
             ->setHelp('Help text for my command')
             ->addArgument('param', InputArgument::REQUIRED, 'Description of the parameter');
    }

    public function handle()
    {
        $myClass = new ExportSeed();
        $result = $myClass->exportar($this->argument('param'));
        $this->info($result);
    }
}
