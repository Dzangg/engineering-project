<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Gesture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-gestures',
    description: 'Add gestures from a JSON file',
)]
class AddGesturesCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('fileName', InputArgument::REQUIRED, 'Gestures JSON file name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dataPath = "./assets/gesturesData/";
        $fileName = $dataPath . $input->getArgument('fileName');
        if (!file_exists($fileName)) {
            $output->writeln("<error>File not found: $fileName</error>");
            return Command::FAILURE;
        }

        $data = json_decode(file_get_contents($fileName), true);
        if ($data === null) {
            $output->writeln('<error>Invalid JSON format in file.</error>');
            return Command::FAILURE;
        }

        foreach ($data as $item) {
            $gesture = $this->entityManager->getRepository(Gesture::class)->findOneBy(['label' => $item['label']]);

            if (!$gesture) {
                $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => $item['category']]);

                if (!$category) {
                    $output->writeln("<error>Category not found: {$item['category']}</error>");
                    continue;
                }

                // Dynamically generate the video path
                $videoPath = './assets/gestureVideos/' . $item['category'] . '/' . $item['label'] . '.mp4';

                $gesture = new Gesture();
                $gesture->setLabel($item['label']);
                $gesture->setVideoPath($videoPath);
                $gesture->setCategory($category); // Set the ManyToOne relation

                $this->entityManager->persist($gesture);
                $output->writeln("Added gesture: {$item['label']} under category: {$item['category']}, video path: $videoPath");
            } else {
                $output->writeln("Gesture already exists: {$item['label']}");
            }
        }

        $this->entityManager->flush();
        $output->writeln('<info>Gestures imported successfully!</info>');

        return Command::SUCCESS;
    }
}
