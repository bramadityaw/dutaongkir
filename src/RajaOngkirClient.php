<?php
namespace bramadityaw\RajaOngkir;

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use bramadityaw\RajaOngkir\ApiSchema\{City, Province, Service};

enum Tier {
    case Starter;
    case Basic;
    case Pro;
}

class RajaOngkirClient{
    public Tier $tier;
    
    public bool $isWorldWide = false;

    private string $apiKey;

    private string $apiUrl; 

    public function __construct(array $options) {
        $this->tier = match($options["tier"]) {
            "starter" => Tier::Starter,
            "basic" => Tier::Basic,
            "pro" => Tier::Pro,
            default => throw new \InvalidArgumentException("Only three tiers available: starter, basic, and pro\nSee: https://rajaongkir.com/dokumentasi/#akun-ringkasan")
        };
        
        $this->apiUrl = $this->tier === Tier::Pro ? "https://pro.rajaongkir.com/api/v2/" : "https://api.rajaongkir.com/";

        $this->apiKey = $options["key"];

        if ($this->tier == Tier::Starter && $options["international"]) {
            throw new \InvalidArgumentException("International option not available for starter tier");
        } else {
            $this->isWorldWide = $options["international"];
        }
    }

    public function province(string $provinceName) : Province {
    
    }
        
    public function city(string $cityName, Province|string $province) : City {
        if (gettype($province) === "string"){
            $province = $this->province($province);
        }
    }

    public function cost(City $from, City $to, int $weight, string $courier) : Service {
        if (gettype($from) === "string") {
            $from = $this->city($from);
        }
        if (gettype($to) === "string") {
            $to = $this->city($to);
        }
    }
}
