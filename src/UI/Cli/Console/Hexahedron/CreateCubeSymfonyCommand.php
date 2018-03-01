<?php
/**
 * Created by PhpStorm.
 * User: oscarlopez1616
 * Date: 20/02/18
 * Time: 1:40
 */

namespace App\UI\Cli\Console\Hexahedron;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use League\Tactician\CommandBus;
use JMS\Serializer\SerializerBuilder;
use App\Application\UseCase\Hexahedron\CreateCubeRequest;
use App\Application\UseCase\Hexahedron\CalculateVolumeIntersectionCubesService;

class CreateCubeSymfonyCommand extends Command
{
    private $commandBus;
    private $serializer;
    private $calculateVolumeIntersecionCubes;

    public function __construct(CommandBus $commandBus, CalculateVolumeIntersectionCubesService $calculateVolumeIntersecionCubes)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
        $this->calculateVolumeIntersecionCubes = $calculateVolumeIntersecionCubes;
        $this->serializer = SerializerBuilder::create()->build();
    }

    protected function configure()
    {
        $this
            ->setName('app:calculate-volume-intersection-of-2-cubes')
            ->setDescription('calculates the volume of the intersection of two cubes')
            ->setHelp('This command allows calculates the volume of the intersection of two cubes ...')
        ;
        $this
            ->addArgument('x1', InputArgument::REQUIRED, 'x of cube1.')
            ->addArgument('y1', InputArgument::REQUIRED, 'y of cube1.')
            ->addArgument('z1', InputArgument::REQUIRED, 'z of cube1.')
            ->addArgument('edge1', InputArgument::REQUIRED, 'edge of cube1.')
            ->addArgument('x2', InputArgument::REQUIRED, 'x of cube2.')
            ->addArgument('y2', InputArgument::REQUIRED, 'y of cube2.')
            ->addArgument('z2', InputArgument::REQUIRED, 'z of cube2.')
            ->addArgument('edge2', InputArgument::REQUIRED, 'edge of cube1.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new CreateCubeRequest($input->getArgument('x1'), $input->getArgument('y1'), $input->getArgument('z1'), $input->getArgument('edge1'));
        $cube1 = $this->commandBus->handle($command);
        $command = new CreateCubeRequest($input->getArgument('x2'), $input->getArgument('y2'), $input->getArgument('z2'), $input->getArgument('edge2'));
        $cube2 = $this->commandBus->handle($command);
        $output->writeln($this->serializer->serialize($this->calculateVolumeIntersecionCubes->execute($cube1, $cube2), 'json'));
    }
}
