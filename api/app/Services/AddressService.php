<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class AddressService
{
    private $postalCode;
    private $client;
    private $return;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->return = [];
    }

    public function getAddress($postalCode)
    {

        $this->postalCode = $this->format($postalCode);
        try {
            $result = $this->client->request('GET', 'https://viacep.com.br/ws/' . $this->postalCode .'/json');
            if ($result->getStatusCode() == Response::HTTP_OK) {
                $r = json_decode($result->getBody()->getContents());
                if (isset($r->erro)) {
                    return array('data' => 'Falha ao buscar o cep', 'error' => true);
                } else {
                    $this->return['postalcode'] = $this->postalCode;
                    $this->return['plane']      = $r->logradouro;
                    $this->return['district']   = $r->bairro;
                    $this->return['city']       = $r->localidade;
                    $this->return['state']      = $r->uf;
                    return array('data' => $this->return, 'error' => false);
                }
            }
        } catch (ClientException $e) {
            return response()->json(Psr7\str($e->getRequest()), Response::HTTP_BAD_REQUEST);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return response()->json(Psr7\str($e->getResponse()), Response::HTTP_BAD_REQUEST);
            }
            return response()->json(Psr7\str($e->getRequest()), Response::HTTP_BAD_REQUEST);
        }


    }

    protected function format($postalCode)
    {
        $er = '/^(\d){5}-(\d){3}$/';

        if (strlen($postalCode) == 9) {
            if (preg_match($er, $postalCode)) {
                $postalCode = preg_replace("/\D+/", "", $postalCode);
            }
        }
        return $postalCode;
    }
}
