<?php

namespace Aoeng\Laravel\Support\Commands;

use Illuminate\Console\Command;

class ModelInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model:install {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install laravel admin model';


    protected $models;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->models = [
            'version'       => 'laravel-admin-version',
            'article'       => 'laravel-admin-article',
            'advertisement' => 'laravel-admin-advertisement'
        ];
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {

        $model = $this->argument('model');
        if (!isset($this->models[$model])) {
            $this->line("Model not find!");
        }
        $ext = $this->models[$model];

        exec("composer show  | grep aoeng/{$ext}", $output);

        if (!empty($output)) {
            $this->line("{$ext} have installed!");
            return;
        }
        $this->line("{$ext} installing!");

        exec("composer require aoeng/{$ext}", $output);

        $this->line("{$ext} install successfully!");

        if (!config('admin', false)) {
            $this->line("Admin installing!");

            $this->call('vendor:publish --provider="Encore\Admin\AdminServiceProvider"');
            $this->call('admin:install');

            $this->line("Admin install successfully!");
        } else {
            $this->call('migrate');
        }

        $this->call("admin:import", $model);

        $this->line("{$ext} import successfully!");
    }

}
