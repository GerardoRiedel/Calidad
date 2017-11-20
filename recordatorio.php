<?php

$bocURL = 'http://www.cetep.cl/calidad/agenda/index.php/api/cron'; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $bocURL); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$bocFile = curl_exec($ch); 
curl_close($ch);

echo 'Envios recordatorios de reclamos Calidad';

;?>