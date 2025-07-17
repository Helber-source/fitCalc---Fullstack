<?php

namespace Controller;

use Model\Imcs;
use Exception;

class ImcController
{
    private $imcsModel;

    public function __construct()
    {
        $this->imcsModel = new Imcs();
    }

//calculo e classificaçao 
    public function calculateImc($weight, $height) {
        try {
            //$result = [
            //'imc' => 22.82,
            //"BMIrange": "Sobrepeso"
            //];
            $result = [];
            if (isset($weight) and isset($height)) {
            if ($weight > 0 and $height > 0) {
            $imc = round($weight / ($height * $height), 2);
            $result['imc'] = $imc;

            $result['BMIrange'] = match (true) {
                $imc < 18.5 => 'Abaixo do peso',
                $imc >= 18.5 && $imc < 24.9 => 'Peso normal',
                $imc >= 25 && $imc < 29.9 => 'Sobrepeso',
                $imc >= 30 && $imc < 34.9 => 'Obesidade grau I',
                $imc >= 35 && $imc < 39.9 => 'Obesidade grau II',
                default => 'Obesidade grau III ou mórbida',
            };
        
        } else {
            $result['BMIrange'] = 'Peso ou altura devem conter valores positivos';
        }
            
        } else {
            $result['BMIrange'] = 'Informe peso ou altura para obter seu IMC';
        }
        return $result;
    }
    
    catch (Exception $error) {
        echo "Erro ao calcular IMC: " . $error->getMessage();
        return false;
    }
}

    public function saveImc($weight, $height, $imcResult) {
      return $this->imcsModel->createImc($weight, $height, $imcResult);
    }
}
?>