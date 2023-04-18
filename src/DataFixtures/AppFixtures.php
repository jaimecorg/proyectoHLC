<?php

namespace App\DataFixtures;

use App\Factory\CitaFactory;
use App\Factory\DuenioFactory;
use App\Factory\EmpleadoFactory;
use App\Factory\MascotaFactory;
use App\Factory\TratamientoFactory;
use App\Factory\VeterinarioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DuenioFactory::createMany(10);

        MascotaFactory::createOne([
            'nombre' => 'Rufo',
            'especie' => 'perro',
            'raza' => 'chiguagua',
            'fechaNacimiento' => '2015-05-12',
        ]);

        EmpleadoFactory::createMany(10);

        TratamientoFactory::createOne([
            'nombre' => 'Lesión',
            'descripcion' => 'pata rota'
        ]);

        VeterinarioFactory::createOne([
            'nombre' => 'juan',
            'apellidos' => 'perea perea',
            'especialidad' => 'anestesia',
            'correo' => 'juan@gmail.com'
        ]);

        CitaFactory::createMany(10, function (){
            return [
                'fecha' => self::faker()->dateTimeThisYear(),
                'mascota' => MascotaFactory::random(),
                'tratamientos' => TratamientoFactory::randomRange(0,1),
                'veterinario' => VeterinarioFactory::random()
            ];
        });

        TratamientoFactory::createMany(10, function (){
            return [
                'citas' => CitaFactory::randomRange(0,1)
            ];
        });


        VeterinarioFactory::createMany(10, function (){
            return [
                'citas' => CitaFactory::randomRange(0,1)
            ];
        });

        MascotaFactory::createMany(10, function (){
            return [
                'duenio' =>DuenioFactory::random(),
                'citas' => CitaFactory::randomRange(0,3)
            ];
        });


        $manager->flush();
    }

    public function faker()
    {
        return Factory::create();
    }
}
