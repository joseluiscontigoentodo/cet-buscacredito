<?php
    $sNumeroTransaccion = $_POST['numeroTx'];
    $sEncryptedData = $_POST['encryptedData'];
    $sCountry = $_POST['country'];

    if (($sCountry != '') && ($sEncryptedData != '') && ($sNumeroTransaccion != '')) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://6yj76mxxeue4ul7zl6zpc76i3i0mfmjz.lambda-url.us-east-1.on.aws/registro/inscripcion',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{ "tx":"'.$sNumeroTransaccion.'", "value":"'.$sEncryptedData.'" }',
            CURLOPT_HTTPHEADER => array('Content-Type: application/json','accept: application/json')
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $json = $data = json_decode($response, true);
        $sId = $json['id'];
        $sRevision = $json['revision'];

        if ($sRevision == '') {
            header("Location: https://portal.contigoentodo.com/#/inscribe/".$sId);
        }
        else {
            header("Location: https://portal.contigoentodo.com/#/login");
        }
    }
    else {
        header("Location: https://portal.contigoentodo.com/#/login");
    }
?>
