<?php

namespace App\Factory;

use App\Entity\Duenio;
use App\Repository\DuenioRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Duenio>
 *
 * @method        Duenio|Proxy create(array|callable $attributes = [])
 * @method static Duenio|Proxy createOne(array $attributes = [])
 * @method static Duenio|Proxy find(object|array|mixed $criteria)
 * @method static Duenio|Proxy findOrCreate(array $attributes)
 * @method static Duenio|Proxy first(string $sortedField = 'id')
 * @method static Duenio|Proxy last(string $sortedField = 'id')
 * @method static Duenio|Proxy random(array $attributes = [])
 * @method static Duenio|Proxy randomOrCreate(array $attributes = [])
 * @method static DuenioRepository|RepositoryProxy repository()
 * @method static Duenio[]|Proxy[] all()
 * @method static Duenio[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Duenio[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Duenio[]|Proxy[] findBy(array $attributes)
 * @method static Duenio[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Duenio[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class DuenioFactory extends ModelFactory
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
            // ->afterInstantiate(function(Duenio $duenio): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Duenio::class;
    }
}
