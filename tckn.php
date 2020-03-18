<?php
if (isset($_POST['sorgula'])) {

    if ($_POST['tckn'] == NULL) {

        echo 'TC Kimlik Numarası boş olamaz.';

    } elseif ($_POST['ad'] == NULL) {

        echo 'Ad boş olamaz';

    } elseif ($_POST['soyad'] == NULL) {

        echo 'Soyad boş olamaz';

    } elseif ($_POST['dy'] == NULL) {

        echo 'Doğum Yılı boş olamaz';

    } else {

        $url = 'https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL';
        $client = new SoapClient($url);

        $result = $client->TCKimlikNoDogrula([
            'TCKimlikNo' => $_POST['tckn'],
            'Ad' => mb_strtoupper($_POST['ad'], "UTF-8"),
            'Soyad' => mb_strtoupper($_POST['soyad'], "UTF-8"),
            'DogumYili' => $_POST['dy']
        ]);

        if ($result->TCKimlikNoDogrulaResult) {

            echo 'TC Kimlik Numarası doğrulandı.';

        } else {

            echo 'TC Kimlik Numarası doğrulanamadı.';

        }

    }

}
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TC Kimlik Doğrulama</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <form method="post">
            <input type="number" name="tckn" placeholder="TC Kimlik Numarası">
            <input type="text" name="ad" placeholder="Ad">
            <input type="text" name="soyad" placeholder="Soyad">
            <input type="number" name="dy" placeholder="Doğum Yılı">
            <button type="submit" name="sorgula">Sorgula</button>
        </form>
    </body>
</html>
