<?php

use Illuminate\Database\Seeder;
use Bgreenacre\Types\TypeModel;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
			'post'           => ['article', 'page'],
			'taxonomy_terms' => ['categories', 'tags'],
        ];

        foreach ($types as $context => $names)
        {
            foreach ($names as $name)
            {
                $typeAdded = (bool) TypeModel::where('context', $context)
                    ->where('name', $name)
                    ->take(1)
                    ->get()
                    ->count();

                if ($typeAdded === false)
                {
                    TypeModel::create(
                        array(
                            'context' => $context,
                            'name'    => $name,
                        )
                    );
                }
            }
        }
    }
}
