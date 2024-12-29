<?php

namespace App\Command;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-categories',
    description: 'Add categories from a JSON file',
)]
class AddCategoriesCommand extends Command
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
            ->addArgument('fileName', InputArgument::REQUIRED, 'Category JSON file name');
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
            $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => $item['name']]);

            if (!$category) {
                $category = new Category();
                $category->setName($item['name']);
                $this->entityManager->persist($category);
                $output->writeln("Added category: {$item['name']}");
            } else {
                $output->writeln("Category already exists: {$item['name']}");
            }
        }

        $this->entityManager->flush();
        $output->writeln('<info>Categories imported successfully!</info>');

        return Command::SUCCESS;
    }
}
