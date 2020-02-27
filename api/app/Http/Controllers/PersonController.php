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
        try {
            return response()->json($this->service->index(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function show($cpf)
    {
        $person = $this->service->show($cpf);
        try {
            return response()->json($person, Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(Request $request)
    {
        // try {
            return $this->service->create($request->all());
        //     ,
        //         Response::HTTP_CREATED
        //     );
        // } catch (\Exception $e) {
        //     return $this->error($e->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);

    }



    public function update(Request $request, $cpf)
    {
        // $person = Person::where('cpf', '=', $cpf)->firstOrFail();

        // $person->name = $request->name;
        // $person->lastname = $request->lastname;
        // // $person->cpf = $request->cpf;
        // $person->postalcode = $request->postalcode;
        // $person->save();

        // return response()->json($person, 'status' => Response::HTTP_OK);

        try {
            return response()->json(
                $this->service->update($cpf, $request->all()),
                Response::HTTP_OK
            );
        } catch (CustomValidationException $e) {
            return $this->error($e->getMessage(), $e->getDetails());
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function destroy($cpf)
    {
        // $person = Person::where('cpf', '=', $cpf)->firstOrFail();
        // $person->delete();
        // return response()->json('Cidadão removido com sucesso', 'status' => Response::HTTP_OK);

        try {
            return response()->json(
                $this->service->destroy($cpf),
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
        return $this->error($e->getMessage());
        }
    }

    //
}
