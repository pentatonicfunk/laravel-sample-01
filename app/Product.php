<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

    const JSON_FILENAME = 'products.json';

    public function findAll()
    {
        return $this->loadJson();
    }

    public function save(array $options = [])
    {
        $json   = $this->loadJson();
        $json[] = array(
            'name'       => $this->name,
            'quantity'   => $this->quantity,
            'price'      => $this->price,
            'data_added' => Carbon::now()->timestamp,
        );
        $this->saveJson($json);
    }

    private function loadJson()
    {
        if (! Storage::disk('local')->exists(self::JSON_FILENAME)) {
            Storage::disk('local')->put(self::JSON_FILENAME, '[]');
        }

        $json = Storage::disk('local')->get(self::JSON_FILENAME);

        return json_decode($json);
    }

    private function saveJson($json)
    {
        if (! Storage::disk('local')->exists(self::JSON_FILENAME)) {
            Storage::disk('local')->put(self::JSON_FILENAME, '[]');
        }

        Storage::disk('local')->put(self::JSON_FILENAME, json_encode($json));

    }
}
