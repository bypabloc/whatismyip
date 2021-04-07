<?php

namespace App\Funciones;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;

use \App\Funciones\FunctionCustom;

class ApiIp
{
    function freegeoip_app($params = []){
        $functionCustom = new FunctionCustom();
        try {
            // $tipo = isset($params['tipo']) ? strtolower($params['tipo']) : null;
            // $numero = isset($params['numero']) ? $params['numero'] : null;

            $client = new Client();
            $res = $client->request('GET', 'https://freegeoip.app/json/', [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);

            $body = $functionCustom->decodificar_json($res->getBody());

            $result = [
                'data' => $body,
            ];
            return $result;
        } catch (ConnectException $e) {
            $result = [
                'errors' => ['No se logró conexion con la API'],
            ];
            return $result;
        } catch (RequestException $e) {
            $result = [
                'errors' => ['Error en la consulta'],
            ];
            if ($e->hasResponse()) {
                $errors = $functionCustom->decodificar_json($e->getResponse()->getBody()->getContents());
                $errors = $functionCustom->objectToArray($errors['errors']);
                $result['errors'] = $errors;
            }
            return $result;
        } catch (ClientException $e) {
            $result = [
                'errors' => ['Error'],
            ];
            if ($e->hasResponse()) {
                $errors = $functionCustom->decodificar_json($e->getResponse()->getBody()->getContents());
                if(isset($errors['errors'])){
                    $errors = $functionCustom->objectToArray($errors['errors']);
                }else{
                    $errors = [$errors['message']];
                }
                $result['errors'] = $errors;
            }
            return $result;
        } catch(Exception $e) {
            $result = [
                'errors' => [$e->getMessage()],
            ];
            return $result;
        }
    }
    /**
     * 
     * 
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://freegeoip.app/json/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    */

    /**
     * http://api.ipstack.com/check
     * ? access_key = YOUR_ACCESS_KEY
    */
    function api_ipstack_com($params = []){
        $functionCustom = new FunctionCustom();
        try {
            // $tipo = isset($params['tipo']) ? strtolower($params['tipo']) : null;
            $access_key = isset($params['access_key']) ? $params['access_key'] : null;

            $client = new Client();
            $res = $client->request('GET', 'http://api.ipstack.com/check?access_key={$access_key}');
            $body = $functionCustom->decodificar_json($res->getBody());

            $result = [];

            if(($body['success'])||(!empty($body['error']))){
                $result['errors'] = $body['error'];
                $result['getPath'] = $res->getUri();
                // $result['getUrl'] = $res->getUrl();
            }

            return $result;
        } catch (ConnectException $e) {
            $result = [
                'errors' => ['No se logró conexion con la API'],
            ];
            return $result;
        } catch (RequestException $e) {
            $result = [
                'errors' => ['Error en la consulta'],
            ];
            if ($e->hasResponse()) {
                $errors = $functionCustom->decodificar_json($e->getResponse()->getBody()->getContents());
                $errors = $functionCustom->objectToArray($errors['errors']);
                $result['errors'] = $errors;
            }
            return $result;
        } catch (ClientException $e) {
            $result = [
                'errors' => ['Error'],
            ];
            if ($e->hasResponse()) {
                $errors = $functionCustom->decodificar_json($e->getResponse()->getBody()->getContents());
                if(isset($errors['errors'])){
                    $errors = $functionCustom->objectToArray($errors['errors']);
                }else{
                    $errors = [$errors['message']];
                }
                $result['errors'] = $errors;
            }
            return $result;
        } catch(Exception $e) {
            $result = [
                'errors' => [$e->getMessage()],
            ];
            return $result;
        }
    }
}
