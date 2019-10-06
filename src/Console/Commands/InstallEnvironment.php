<?php

namespace daxter1987\LaravelEnv\Commands;

use Illuminate\Console\Command;

class InstallEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dax:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs docker compose environment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Creating environent\n";

        $docker_compose_file_content = file_get_contents('vendor/daxter1987/laravel-env/src/resources/docker-compose.yml');

        $unique_name = uniqid();

        $docker_compose_file = str_replace("CONTAINER_NAME", $unique_name, $docker_compose_file_content);

        //write to root folder
        $handle = fopen("docker-compose.yml", 'w') or die('Cannot open file: docker-compose.yml');
        fwrite($handle, $docker_compose_file);

        $bash_content = file_get_contents('vendor/daxter1987/laravel-env/src/resources/daxenv.sh');

        $bash_content_file = str_replace("CONTAINER_NAME", $unique_name, $bash_content);

        //write to root folder
        $handle = fopen("daxenv.sh", 'w') or die('Cannot open file: daxenv.sh');
        fwrite($handle, $bash_content_file);

        $gitignore_content = file_get_contents('.gitignore');

        if(strpos($gitignore_content, "/db") !== false){
            echo "gitignore is set up";
        }else{
            $handle = fopen(".gitignore", 'a') or die('Cannot open file: .gitignore');
            fwrite($handle, "/db");
        }

        echo "Environment created\n";
    }
}
