<?php

namespace DescomMarket\Seo\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Install extends Command
{
    protected $signature = 'skeleton:install';

    protected $description = 'Install package DescommarketSeo';

    public function handle()
    {
        $this->info('Installing package DescommarketSeo...');

        $this->info('Publishing configuration...');

        if (! $this->configExists('skeleton.php')) {
            $this->publishConfiguration();
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed package DescommarketSeo');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $this->info('Overwriting configuration file...');

        $params = [
            '--provider' => "DescomMarket\Seo\DescommarketSeoServiceProvider",
            '--tag' => 'config',
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);

        $this->info('Published configuration');
    }
}
