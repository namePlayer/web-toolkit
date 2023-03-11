<?php
declare(strict_types=1);

namespace App\Command;

use App\Software;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CacheClearCommand extends Command
{

    protected static $defaultName = 'cache:clear';
    protected static $defaultDescription = 'Clear the application cache';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('<fg=black;bg=blue>Starting Cache Clearing Operation</>' . PHP_EOL);

        $count = 0;
        foreach (glob(Software::CACHE_DIR . '/*') as $file) {
            if ($file !== '.gitignore') {
                unlink($file);
                $count++;
            }
        }

        $output->write('<fg=black;bg=blue>Cleared ' . $count . ' files from Cache</>' . PHP_EOL);

        return Command::SUCCESS;
    }

}
