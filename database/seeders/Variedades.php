<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Variedades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_variedades')->insert([
            // Cereales
            ['tipo_cultivo_id' => 1, 'nombre_cientifico' => 'Zea mays', 'variedad' => 'Maíz'],
            ['tipo_cultivo_id' => 1, 'nombre_cientifico' => 'Oryza sativa', 'variedad' => 'Arroz'],
            ['tipo_cultivo_id' => 1, 'nombre_cientifico' => 'Sorghum bicolor', 'variedad' => 'Sorgo'],

            // Leguminosas
            ['tipo_cultivo_id' => 2, 'nombre_cientifico' => 'Phaseolus vulgaris', 'variedad' => 'Frijol'],
            ['tipo_cultivo_id' => 2, 'nombre_cientifico' => 'Cajanus cajan', 'variedad' => 'Quinchoncho'],
            ['tipo_cultivo_id' => 2, 'nombre_cientifico' => 'Vigna unguiculata', 'variedad' => 'Caraota'],

            // Oleaginosas
            ['tipo_cultivo_id' => 3, 'nombre_cientifico' => 'Glycine max', 'variedad' => 'Soja'],
            ['tipo_cultivo_id' => 3, 'nombre_cientifico' => 'Helianthus annuus', 'variedad' => 'Girasol'],
            ['tipo_cultivo_id' => 3, 'nombre_cientifico' => 'Sesamum indicum', 'variedad' => 'Ajonjolí'],
            ['tipo_cultivo_id' => 3, 'nombre_cientifico' => 'Elaeis guineensis', 'variedad' => 'Palma aceitera'],

            // Hortalizas
            ['tipo_cultivo_id' => 4, 'nombre_cientifico' => 'Solanum lycopersicum', 'variedad' => 'Tomate'],
            ['tipo_cultivo_id' => 4, 'nombre_cientifico' => 'Capsicum annuum', 'variedad' => 'Pimiento'],
            ['tipo_cultivo_id' => 4, 'nombre_cientifico' => 'Lactuca sativa', 'variedad' => 'Lechuga'],
            ['tipo_cultivo_id' => 4, 'nombre_cientifico' => 'Daucus carota', 'variedad' => 'Zanahoria'],
            ['tipo_cultivo_id' => 4, 'nombre_cientifico' => 'Brassica oleracea', 'variedad' => 'Brócoli'],

            // Frutales
            ['tipo_cultivo_id' => 5, 'nombre_cientifico' => 'Citrus sinensis', 'variedad' => 'Naranja'],
            ['tipo_cultivo_id' => 5, 'nombre_cientifico' => 'Mangifera indica', 'variedad' => 'Mango'],
            ['tipo_cultivo_id' => 5, 'nombre_cientifico' => 'Persea americana', 'variedad' => 'Aguacate'],
            ['tipo_cultivo_id' => 5, 'nombre_cientifico' => 'Passiflora edulis', 'variedad' => 'Parchita'],
            ['tipo_cultivo_id' => 5, 'nombre_cientifico' => 'Musa paradisiaca', 'variedad' => 'Cambur'],
            ['tipo_cultivo_id' => 5, 'nombre_cientifico' => 'Ananas comosus', 'variedad' => 'Piña'],

            // Ornamentales
            ['tipo_cultivo_id' => 6, 'nombre_cientifico' => 'Rosa spp.', 'variedad' => 'Rosa'],
            ['tipo_cultivo_id' => 6, 'nombre_cientifico' => 'Tulipa spp.', 'variedad' => 'Tulipán'],
            ['tipo_cultivo_id' => 6, 'nombre_cientifico' => 'Orchidaceae spp.', 'variedad' => 'Orquídea'],

            // Raíces y Tubérculos
            ['tipo_cultivo_id' => 7, 'nombre_cientifico' => 'Solanum tuberosum', 'variedad' => 'Papa'],
            ['tipo_cultivo_id' => 7, 'nombre_cientifico' => 'Manihot esculenta', 'variedad' => 'Yuca'],
            ['tipo_cultivo_id' => 7, 'nombre_cientifico' => 'Dioscorea alata', 'variedad' => 'Ñame'],
            ['tipo_cultivo_id' => 7, 'nombre_cientifico' => 'Xanthosoma sagittifolium', 'variedad' => 'Ocumo'],

            // Cultivos para Bebidas Medicinales y Aromáticas
            ['tipo_cultivo_id' => 8, 'nombre_cientifico' => 'Camellia sinensis', 'variedad' => 'Té'],
            ['tipo_cultivo_id' => 8, 'nombre_cientifico' => 'Coffea arabica', 'variedad' => 'Café'],
            ['tipo_cultivo_id' => 8, 'nombre_cientifico' => 'Matricaria chamomilla', 'variedad' => 'Manzanilla'],
            ['tipo_cultivo_id' => 8, 'nombre_cientifico' => 'Cymbopogon citratus', 'variedad' => 'Malojillo'],
            ['tipo_cultivo_id' => 8, 'nombre_cientifico' => 'Mentha piperita', 'variedad' => 'Menta'],

            // Cultivos Tropicales Tradicionales
            ['tipo_cultivo_id' => 9, 'nombre_cientifico' => 'Coffea arabica', 'variedad' => 'Café'],
            ['tipo_cultivo_id' => 9, 'nombre_cientifico' => 'Theobroma cacao', 'variedad' => 'Cacao'],
            ['tipo_cultivo_id' => 9, 'nombre_cientifico' => 'Saccharum officinarum', 'variedad' => 'Caña de azúcar'],
            ['tipo_cultivo_id' => 9, 'nombre_cientifico' => 'Nicotiana tabacum', 'variedad' => 'Tabaco'],

            // Pastos
            ['tipo_cultivo_id' => 10, 'nombre_cientifico' => 'Cynodon dactylon', 'variedad' => 'Bermuda'],
            ['tipo_cultivo_id' => 10, 'nombre_cientifico' => 'Pennisetum purpureum', 'variedad' => 'Pasto elefante'],
            ['tipo_cultivo_id' => 10, 'nombre_cientifico' => 'Brachiaria brizantha', 'variedad' => 'Braquiaria'],
        ]);

        Db::table('cat_variedades')->update([
            'tipo' => 'Convencional',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
