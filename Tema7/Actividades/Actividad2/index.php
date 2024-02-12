<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles.css">
        <title>API Traductor</title>
    </head>
    <body>
        <form action="" method="POST">
            <label>Texto a traducir: <input type="text" name="texto"></label>
            <input type="submit" name="traducir" value="Traducir">
        </form>
    </body>
</html>
<?php 
    if(isset($_POST["traducir"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $texto = $_POST["texto"];

        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://text-translator2.p.rapidapi.com/translate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "source_language=es&target_language=en&text=$texto",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: text-translator2.p.rapidapi.com",
                "X-RapidAPI-Key: 7d3e313decmshb7218938d70ede6p1a1a0ajsn929656550758",
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
            echo "<h2>Original: </h2><p>" . $texto . "</p>";
            echo "<h2>Translated: </h2><p>" . $response->data->translatedText . "</p>";
        }
    }

?>