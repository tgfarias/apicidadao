<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PersonService;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PersonController extends Controller
{

    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(PersonService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($cpf)
    {
        return $this->service->show($cpf);
    }

    public function create(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function update(Request $request, $cpf)
    {
        return $this->service->update($request->all(), $cpf);
    }

    public function destroy($cpf)
    {
        return $this->service->destroy($cpf);
    }

}
