<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return round(floatval($value) / 100, precision: 2); // Mengubah nilai ke float dan membaginya dengan 100, lalu membulatkannya hingga dua desimal
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */

    /**

    * Prepare the given value for storage.
    *
    * @param  array<string, mixed>  $attributes
    * @param  Model  $model  Model yang sedang digunakan
    * @param  string  $key  Kunci dari atribut yang sedang diakses
    * @param  mixed  $value  Nilai dari atribut yang sedang diakses
    * @return mixed  Nilai yang sudah diubah untuk disimpan ke database
    */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return round(floatval($value) * 100); // Mengubah nilai ke float dan mengalikannya dengan 100, lalu membulatkannya
    }
}
