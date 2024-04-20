<?php
use bramadityaw\RajaOngkir\RajaOngkirClient;

require_once realpath(__DIR__ . '/vendor/autoload.php');

include __DIR__ . 'env.php'; 

$rajaongkir = new RajaOngkirClient([
    "tier" => "starter",
    "key" => getenv("RAJA_ONGKIR_API_KEY"),
    "international" => false,
]);

echo getenv("RAJA_ONGKIR_API_KEY");


$provinsi = $rajaongkir->province("jawa_barat");
$kota = $rajaongkir->city("magelang", $rajaongkir->province("jawa_tengah"));
$ongkir = $rajaongkir->cost($rajaongkir->city("bandung_kota", "jawa_barat"), 
                            $kota, 1200, "jne");
