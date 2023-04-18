<?php

namespace App\Factory;

use App\Entity\Veterinario;
use App\Repository\VeterinarioRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Veterinario>
 *
 * @method        Veterinario|Proxy create(array|callable $attributes = [])
 * @method static Veterinario|Proxy createOne(array $attributes = [])
 * @method static Veterinario|Proxy find(object|array|mixed $criteria)
 * @method static Veterinario|Proxy findOrCreate(array $attributes)
 * @method static Veterinario|Proxy first(string $sortedField = 'id')
 * @method static Veterinario|Proxy last(string $sortedField = 'id')
 * @method static Veterinario|Proxy random(array $attributes = [])
 * @method static Veterinario|Proxy randomOrCreate(array $attributes = [])
 * @method static VeterinarioRepository|RepositoryProxy repository()
 * @method static Veterinario[]|Proxy[] all()
 * @method static Veterinario[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Veterinario[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Veterinario[]|Proxy[] findBy(array $attributes)
 * @method static Veterinario[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Veterinario[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class VeterinarioFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'nombre' => self::faker()->firstName(),
            'apellidos' => self::faker()->lastName() . ' ' . self::faker()->lastName(),
            'especialidad' => self::faker()->word(),
            'correo' => self::faker()->email(),
            'telefono' => self::faker()->mobileNumber(),
            'direccion' => self::faker()->streetAddress(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Veterinario $veterinario): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Veterinario::class;
    }
}
