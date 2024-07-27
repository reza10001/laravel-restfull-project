<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class ApiRequestMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apiRequest {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crate a new api request class';

    /**
     * Execute the console command.
     */
   protected function getStub(){
        return __DIR__.'/Stubs/api-request.stub'; 
   }
   protected function getDefaultNamespace($rootNamespace){
    return $rootNamespace.'/Http/ApiRequest';
   }
}
