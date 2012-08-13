<?php

namespace Jimdo\JimFlow\ImportBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use \Jimdo\JimFlow\ImportBundle\FileHandler\FileLocator;
use \Symfony\Component\Finder\Finder;
use \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use \Jimdo\JimFlow\ImportBundle\Exception\NoMatchingFileException;

class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('jimflow:import')
            ->setDescription('Import of json files')
            ->addArgument('dir', InputArgument::REQUIRED, 'Directory of import')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $directory = $input->getArgument('dir');

        $importRunner = $this->getContainer()->get('jimdo.import_runner');
        
        try {
            $importRunner->run($directory);
        } catch (NoMatchingFileException $e) {
            $output->writeln(sprintf('<comment>%s</comment>', $e->getMessage()));

        }
    }
}