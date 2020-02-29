<?php

namespace App\Console\Commands;

use App\Services\PersonService;

use Exception;
use Illuminate\Console\Command;

class CreatePersonCommand extends Command
{

    protected $signature = "create-person.php {name} {lastname} {cpf} {phone?} {email?} {cellphone?} {postalcode?}";

    protected $descrition = "Created person with arguments using command line";

    private $service;

    public function __construct(PersonService $service)
    {
        $this->service = $service;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // $questions = [
        //     'name'       => 'Qual seu nome?',
        //     'lastname'   => 'Qual seu sobrenome?',
        //     'cpf'        => 'Qual número do seu CPF?',
        //     'phone'      => 'Qual seu telefone? (99) 9999-9999',
        //     'email'      => 'Qual seu email?',
        //     'cellphone'  => 'Qual seu número de celular? (99) 9999-9999',
        //     'postalcode' => 'Qual o seu CEP?'
        // ];

        // $answers = [];

        // foreach($questions as $key => $question){
        //     $answer = $this->ask($question);
        //     if ($answer != '') {
        //         $answers = array_merge($answers, [$key => $answer]);
        //     }
        // }
        $this->line("Inserir Cidadão com a seguinte ordem: {nome} {sobrenome} {cpf} {telefone} {email} {celular} {cep}");
        try {
            $arguments = $this->arguments();
            print_r($arguments);
            $this->info($this->service->create($arguments));
        } catch (Exception $e) {
            $this->error("An error occurred " . $e->getMessage() );
        }
    }
}
