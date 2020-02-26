<?php

namespace App\Http\Controllers;

use App\Model\Person;
use App\Model\Contact;
use Illuminate\Http\Request;
use Validator;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $persons = Person::orderBy('name', 'asc')->get();
        return response()->json($persons);
    }

    public function create(Request $request)
    {

        $person = new Person;

        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'cpf' => 'required|min:11|max:14|unique:persons',
            'postalcode' => 'min:8|max:9',
        ];

        $this->validate($request, $rules);

        // $validate = Validator::make($request->all(), $rules, $messages);

        // if($validate->fails()) {
        //     return back()->witherrors($validate)->withInput();
        // }
        //dd($validator->fails());

        $person->name = $request->name;
        $person->lastname = $request->lastname;
        $person->cpf = $request->cpf;
        $person->postalcode = $request->postalcode;

        $person->save();

        $contact = new Contact;

        foreach ($request->contacts as $c) {
            $contact->type = $c['type'];
            $contact->contact = $c['contact'];
            $contact->person_id = $person->id;
            $contact->save();
            $person->contacts[] = $contact;

        }

        return response()->json($person, 201);
    }

    public function show($cpf)
    {
        $data = ['cpf' => $cpf];

        $validator = \Validator::make($data, [
            'cpf' => 'required|cpf'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $person = Person::where('cpf', '=', $cpf)->firstOrFail();

        return response()->json($person);
    }

    public function update(Request $request, $cpf)
    {
        $person = Person::where('cpf', '=', $cpf)->firstOrFail();

        $person->name = $request->name;
        $person->lastname = $request->lastname;
        $person->cpf = $request->cpf;
        $person->postalcode = $request->postalcode;
        $person->save();

        return response()->json($person);
    }

    public function destroy($cpf)
    {
        $person = Person::where('cpf', '=', $cpf)->firstOrFail();
        $person->delete();
        return response()->json('Cidadão removido com sucesso');
    }

    //
}
