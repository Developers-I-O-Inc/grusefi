<?php

namespace App\Imports;

use App\Models\Operation\EmbarquesProductos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmbarquesProductos([
            'embarque_id' => $row['embarque_id'],
            'variedad_id' => $row['variedad_id'],
            'presentacion_id' => $row['presentacion_id'],
            'folio_pallet' => $row['folio_pallet'],
            'lote' => $row['lote'],
            'sader' => $row['sader'],
            'cartilla' => $row['cartilla'],
            'cantidad' => $row['cantidad'],
            'peso' => $row['peso'],
            'marca_id'=> $row['marca_id'],
        ]);
    }

    public function customValidationMessages()
    {
        return [
            'embarque_id.exists' => 'El id de embarque no es válido.',
            'variedad_id.exists' => 'El id de variedad no es válido.',
            'presentacion_id.exists' => 'El id de presentación no es válido.',
            'folio_pallet.required' => 'El folio de pallet es requerido.',
            'folio_pallet.string' => 'El folio de pallet debe ser una cadena de texto.',
            'lote.required' => 'El lote es requerido.',
            'lote.string' => 'El lote debe ser una cadena de texto.',
            'sader.required' => 'El sader es requerido.',
            'sader.string' => 'El sader debe ser una cadena de texto.',
            'cartilla.required' => 'El sader es requerido.',
            'cartilla.string' => 'El sader debe ser una cadena de texto.',
            'cantidad.required' => 'Las cantidades son requeridas.',
            'cantidad.integer' => 'Las cantidades deben ser un número entero.',
            'peso.required' => 'El peso es requerido.',
            'peso.decimal' => 'El peso debe ser un número decimal.',
        ];
    }

    public function rules(): array
    {
        return [
            'embarque_id' => 'exists:op_embarques,id',
            'variedad_id' => 'exists:cat_variedades,id',
            'presentacion_id' => 'exists:cat_presentaciones,id',
            'folio_pallet' => 'required|string',
            'lote' => 'required|string',
            'sader' => 'required|string',
            'cartilla' => 'required|string',
            'cantidad' => 'required|integer',
            'peso' => 'required|numeric',
        ];
    }
}
