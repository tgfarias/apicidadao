<?php

namespace App\Services;

use App\Models\ValidationPerson;
use App\Repositories\PersonRepositoryInterface;
use App\Exceptions\CustomValidationException;
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
        return $this->personRepository->index();
    }

    public function show($cpf)
    {
        return $this->personRepository->show($cpf);
    }

    public function create(array $data)
    {
        $validator = \Validator::make($data, ValidationPerson::RULE_PERSON);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        if ($data['postalcode']) {
            $result = $this->addressService->getAddress($data['postalcode']);
            if ($result['error']) {
                echo $result['data'];
                unset($data['postalcode']);
            } else {
                $data = array_merge($data, $result['data']);
            }
        }
        try {
            return response()->json($this->personRepository->create($data), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function update($cpf, array $data)
    {
        $validator = Validator::make($data, ValidationPerson::RULE_PERSON);

        if ($validator->fails()) {
            // throw new CustomValidationException('Falha na validação dos dados', $validator->errors());
        }

        return $this->personRepository->update($cpf, $data);
    }

    public function destroy($cpf)
    {
        return $this->personRepository->destroy($cpf);
    }

}
