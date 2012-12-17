<?php
namespace Mokos\Console;
use Symfony\Component\Console\Command\Command;

class GenerateAllCommand extends Command {

	public function configure() {
		$this
		->setName('all')
		->setDescription('Generate all tiers (dao, mapper, service)')
		;
	}
	
	public function execute($input, $output) {
		//do something...
	}
}
