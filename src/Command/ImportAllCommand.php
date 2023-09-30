<?php

declare(strict_types=1);

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
        unset($traderCmd);

        // Import bosses
        $bossesCmd = $this->getApplication()->find('app:import:bosses');
        $bossesCmd->run($inputArguments, $output);
        unset($bossesCmd);

        // Import maps
        $mapsCmd = $this->getApplication()->find('app:import:maps');
        $mapsCmd->run($inputArguments, $output);
        unset($mapsCmd);

        // Import items materials
        $itemsMaterialCmd = $this->getApplication()->find('app:import:items-materials');
        $itemsMaterialCmd->run($inputArguments, $output);
        unset($itemsMaterialCmd);

        // Import items
        $itemsCmd = $this->getApplication()->find('app:import:items');
        $itemsCmd->run($inputArguments, $output);
        unset($itemsCmd);

        // Import properties items
        $itemsPropertiesCmd = $this->getApplication()->find('app:import:items-properties');
        $itemsPropertiesCmd->run($inputArguments, $output);
        unset($itemsPropertiesCmd);

        // Import quests items
        $questsItemsCmd = $this->getApplication()->find('app:import:quests-items');
        $questsItemsCmd->run($inputArguments, $output);
        unset($questsItemsCmd);

        // Import quests
        $questsCmd = $this->getApplication()->find('app:import:quests');
        $questsCmd->run($inputArguments, $output);
        unset($questsCmd);

        // Import barters
        $bartersCmd = $this->getApplication()->find('app:import:barters');
        $bartersCmd->run($inputArguments, $output);
        unset($bartersCmd);

        // Import crafts
        $placesCmd = $this->getApplication()->find('app:import:places');
        $placesCmd->run($inputArguments, $output);
        unset($placesCmd);

        // Import crafts
        $craftsCmd = $this->getApplication()->find('app:import:crafts');
        $craftsCmd->run($inputArguments, $output);
        unset($craftsCmd);

        // Import cash offers
        $cashOfferCmd = $this->getApplication()->find('app:import:traders:cash-offers');
        $cashOfferCmd->run($inputArguments, $output);
        unset($cashOfferCmd);

        $io->success('Database import successful.');

        return Command::SUCCESS;
    }
}
