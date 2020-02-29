<?php

namespace App\Services;

use App\Models\ValidationPerson;
use App\Repositories\PersonRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Services\AddressService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class PersonService
{
    private $personRepository;
    private $addressService;

    public function __construct(PersonRepositoryInterface $personRepository, AddressService $addressService)
    {
        $this->personRepository = $personRepository;
        $this->addressService = $addressService;

    }

    public function index()
    {
        try {
            return response()->json($this->personRepository->index(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show($cpf)
    {

        $validator = \Validator::make(['cpf' => $cpf], ValidationPerson::RULE_CPF);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (strlen($cpf) == 14) {
            $cpf = preg_replace("/\D+/", "", $cpf);
        }

        try {
            return response()->json($this->personRepository->show($cpf), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function create(array $data)
    {

        $validator = \Validator::make($data, ValidationPerson::RULE_PERSON);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (strlen($data['cpf']) == 14) {
            $data['cpf'] = preg_replace("/\D+/", "", $data['cpf']);
        }

        if ($data['postalcode']) {
            $result = $this->addressService->getAddress($data['postalcode']);
            if ($result['error']) {
                return response()->json('CEP inválido', Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $data = array_merge($data, $result['data']);
            }
        }
        try {
            return response()->json($this->personRepository->create($data), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(array $data, $cpf)
    {
        $data['cpf'] = $cpf;
        $validator = \Validator::make($data, ValidationPerson::RULE_PERSON_UPDATE);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (strlen($cpf) == 14) {
            $data['cpf'] = preg_replace("/\D+/", "", $cpf);
        }

        if ($data['postalcode']) {
            $result = $this->addressService->getAddress($data['postalcode']);
            if ($result['error']) {
                return response()->json('CEP inválido', Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $data = array_merge($data, $result['data']);
            }
        }

        try {
            return response()->json($this->personRepository->update($data, $data['cpf']), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy($cpf)
    {
        $validator = \Validator::make(['cpf' => $cpf], ValidationPerson::RULE_CPF);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (strlen($cpf) == 14) {
            $cpf = preg_replace("/\D+/", "", $cpf);
        }

        try {
            return response()->json($this->personRepository->destroy($cpf), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
