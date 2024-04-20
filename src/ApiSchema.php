<?php

namespace bramadityaw\RajaOngkir;

class Province {
    public string $id;
    public string $name;
}

enum CityType {
    case Kota;
    case Kabupaten;
}

class City {
    public string $id;
    public Province $province;
    public CityType $type;
    public string $name;
    public string $postalCode;
}

class Courier {
    public string $code;
    public string $name;
    public array $services; // array<Service>
}

class ArrayOfServices extends \ArrayObject {
    public function offsetSet($key, $val) {
        if ($val instanceof Service) {
            return parent::offsetSet($key, $val);
        }
        throw new \InvalidArgumentException('Value must be a Foo');
    }
}

class Service {
    public string $name;
    public string $description;
    public ServiceDetails $details;
}

class ServiceDetails {
    public int $price;
    public \DateInterval $untilArrival;
    public string $note;

}
