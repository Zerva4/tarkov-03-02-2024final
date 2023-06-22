<?php

namespace App\Command;

use App\Entity\Weather;
use App\Interfaces\GraphQLClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:import:weather',
    description: 'Import weather from API https://api.tarkov-changes.com',
)]
class ImportWeatherCommand extends Command
{
    private ?EntityManagerInterface $em;
    private HttpClientInterface $client;

    private string $url;

    private string $token;

    public function __construct(EntityManagerInterface $em, HttpClientInterface $client, KernelInterface $kernel) {
        parent::__construct();

        $this->em = $em;
        $this->client = $client;

        $this->url = $kernel->getContainer()->getParameter('app.import.weather.url');
        $this->token = $kernel->getContainer()->getParameter('app.import.weather.token');
    }
    protected function configure(): void
    {
        $this
            ->setDescription('Import weather from API https://api.tarkov-changes.com')
            ->addOption('lang', 'l', InputArgument::OPTIONAL, 'Language', default: 'ru')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $response = $this->client->request(
            'GET',
            $this->url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'AUTH-Token' => $this->token
                ],
            ]
        );

        try {
            $content = json_decode($response->getContent(), true);
            $weather = $content['results'][0];
        } catch (Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        if (null === $weather) {
            $io->warning('Nothing to import.');
        }

        $weatherEntity = new Weather();
        $weatherEntity
            ->setTimestamp($weather['timestamp'])
            ->setCloud($weather['cloud'])
            ->setWindSpeed($weather['wind_speed'])
            ->setWindDirection($weather['wind_direction'])
            ->setWindGustiness($weather['wind_gustiness'])
            ->setRain($weather['rain'])
            ->setRainIntensivity($weather['rain_intensity'])
            ->setFog($weather['fog'])
            ->setTemp($weather['temp'])
            ->setPressure($weather['pressure'])
        ;
        $this->em->persist($weatherEntity);
        $this->em->flush();

        $io->success('Weather imported.');

        return Command::SUCCESS;
    }
}
