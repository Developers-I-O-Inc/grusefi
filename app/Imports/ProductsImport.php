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
            'categoria_id' => $row['categoria_id'],
            'presentacion_id' => $row['presentacion_id'],
            'calibre_id' => $row['calibre_id'],
            'folio_pallet' => $row['folio_pallet'],
            'sader' => $row['sader'],
            'cajas' => $row['cajas'],
            'lote' => $row['lote'],
            'tipo_fruta' => $row['tipo_fruta'],
            'cartilla' => $row['cartilla']
        ]);
    }

    public function customValidationMessages()
    {
        return [
            'embarque_id.exists' => 'El id de embarque no es válido.',
            'categoria_id.exists' => 'El id de categoría no es válido.',
            'presentacion_id.exists' => 'El id de presentación no es válido.',
            'calibre_id.exists' => 'El id de calibre no es válido.',
            'folio_pallet.required' => 'El folio de pallet es requerido.',
            'folio_pallet.string' => 'El folio de pallet debe ser una cadena de texto.',
            'sader.required' => 'El sader es requerido.',
            'sader.string' => 'El sader debe ser una cadena de texto.',
            'cajas.required' => 'Las cajas son requeridas.',
            'cajas.integer' => 'Las cajas deben ser un número entero.',
            'lote.required' => 'El lote es requerido.',
            'lote.string' => 'El lote debe ser una cadena de texto.',
            'tipo_fruta.required' => 'El tipo de fruta es requerido.',
            'tipo_fruta.string' => 'El tipo de fruta debe ser una cadena de texto.',
        ];
    }

    public function rules(): array
    {
        return [
            'embarque_id' => 'exists:op_embarques,id',
            'categoria_id' => 'exists:cat_categorias,id',
            'presentacion_id' => 'exists:cat_presentaciones,id',
            'calibre_id' => 'exists:cat_calibres,id',
            'folio_pallet' => 'required|string',
            'sader' => 'required|string',
            'cajas' => 'required|integer',
            'lote' => 'required|string',
            'tipo_fruta' => 'required|string',
            'cartilla' => 'required|string',
        ];
    }
}
