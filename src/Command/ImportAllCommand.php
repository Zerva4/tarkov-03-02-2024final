<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import:all',
    description: 'Import or update all game elements',
)]
class ImportAllCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arguments = [
            '--lang' => $input->getOption('lang')
        ];
        $inputArguments = new ArrayInput($arguments);

        $io->info('Import or update all game elements for language: '.$input->getOption('lang'));

        // Import traders
        $traderCmd = $this->getApplication()->find('app:import:traders');
        $traderCmd->run($inputArguments, $output);

        // Import traders
        $traderCmd = $this->getApplication()->find('app:import:bosses');
        $traderCmd->run($inputArguments, $output);

        // Import maps
        $mapsCmd = $this->getApplication()->find('app:import:maps');
        $mapsCmd->run($inputArguments, $output);

        // Import items materials
        $itemsCmd = $this->getApplication()->find('app:import:items-materials');
        $itemsCmd->run($inputArguments, $output);

        // Import items
        $itemsCmd = $this->getApplication()->find('app:import:items');
        $itemsCmd->run($inputArguments, $output);

        // Import quests items
        $questsCmd = $this->getApplication()->find('app:import:quests-items');
        $questsCmd->run($inputArguments, $output);

        // Import quests
        $questsCmd = $this->getApplication()->find('app:import:quests');
        $questsCmd->run($inputArguments, $output);

        // Import barters
        $questsCmd = $this->getApplication()->find('app:import:barters');
        $questsCmd->run($inputArguments, $output);

        // Import crafts
        $questsCmd = $this->getApplication()->find('app:import:places');
        $questsCmd->run($inputArguments, $output);

        // Import crafts
        $questsCmd = $this->getApplication()->find('app:import:crafts');
        $questsCmd->run($inputArguments, $output);

        $io->success('Database import successful.');

        return Command::SUCCESS;
    }
}
