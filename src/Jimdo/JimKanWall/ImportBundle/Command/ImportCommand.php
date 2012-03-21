<?php

namespace Jimdo\JimKanWall\ImportBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use \Jimdo\JimKanWall\ImportBundle\FileLocator\FileLocator;
use \Symfony\Component\Finder\Finder;

class ImportCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('jimkanwall:import')
            ->setDescription('Greet someone')
            ->addArgument('dir', InputArgument::REQUIRED, 'Directory of import')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = $input->getArgument('dir');

        $finder = new Finder();
        $fileLocator = new FileLocator($finder);
        $importFile = $fileLocator->getOldestFile($dir);

        if(!isset($importFile)) {
            $output->writeln('<comment>No file to import</comment>');
        }
        else {
            $string = file_get_contents($importFile);
            $json = json_decode($string);

            echo $json->board->info->date;
        }


    }
}