<?php

declare(strict_types=1);

/*
 * This file is part of konceiver/laravel-playbooks.
 *
 * (c) Konceiver <info@konceiver.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Konceiver\Playbooks\Providers;

use Illuminate\Support\ServiceProvider;
use Konceiver\Playbooks\Commands\RunPlaybookCommand;

class PlaybooksServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/playbooks.php', 'playbooks');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/playbooks.php' => $this->app->configPath('playbooks.php'),
            ], 'config');

            $this->commands([RunPlaybookCommand::class]);
        }
    }
}
