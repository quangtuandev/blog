<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateTraits extends GeneratorCommand
{
   
    protected $name = 'make:Trait';

    protected $description = 'Create a new Traits class';

   
    protected $type = 'Traits';

    protected function getStub()
    {
        return __DIR__.'/stubs/Traits.stub';
    }
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Traits';
    }
}
