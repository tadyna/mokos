<?php
namespace Mokos\Console\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @author     derhaa
 * @category   Console
 * @package    Console
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Base command for generation process
 */
class GenerateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('mokos:generate')
            ->setDescription('Basic command')
            ->addArgument(
                'component',
                InputArgument::REQUIRED,
                'Specify which components you want generate'
            )
            ->addOption(
               'domain',
               'd',
               InputOption::VALUE_NONE,
               'If set, the task will generate only domain objects'
            )
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('component');
        if ($name === 'component') {
            $text = 'Hello '.$name;
            if ($input->getOption('domain')) {
                $text = strtoupper($text);
            }            
        } else {
            $text = 'Hello';
        }
        $output->writeln($text);
    }
}