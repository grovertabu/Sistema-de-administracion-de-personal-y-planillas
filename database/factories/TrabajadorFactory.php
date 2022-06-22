<?php

namespace Database\Factories;

use App\Models\Trabajador;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrabajadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trabajador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ci'=>$this->faker->numberBetween($min = 1000000, $max = 1999999),
            'complemento'=>$this->faker->randomElement($array = array ('','a','c')),
            'expedido'=>$this->faker->randomElement($array = array ('CH','LP','CB','OR','PT','SC')),
            'nro_asegurado'=>$this->faker->numberBetween($min = 1000, $max = 9000),
            'nombre'=>strtoupper($this->faker->firstName),
            'apellido_paterno'=>strtoupper($this->faker->lastName),
            'apellido_materno'=>strtoupper($this->faker->lastName),
            'direccion'=>$this->faker->streetName,
            'sexo'=>$this->faker->randomElement($array = array ('masculino','femenino')),
            'nacionalidad'=>$this->faker->state,
            'fecha_nacimiento'=>$this->faker->date($format = 'Y-m-d', $max = '1980-01-01'),
            'antiguedad_anios'=>$this->faker->year($max = 'now'),
            'antiguedad_meses'=>$this->faker->month($max = 'now') ,
            'antiguedad_dias'=>$this->faker->dayOfMonth($max = 'now'),
            'foto'=>"",
            'estado_trabajador'=>"habilitado",
        ];
    }
}
