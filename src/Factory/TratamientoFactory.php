<?php

namespace App\Factory;

use App\Entity\Tratamiento;
use App\Repository\TratamientoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Tratamiento>
 *
 * @method        Tratamiento|Proxy create(array|callable $attributes = [])
 * @method static Tratamiento|Proxy createOne(array $attributes = [])
 * @method static Tratamiento|Proxy find(object|array|mixed $criteria)
 * @method static Tratamiento|Proxy findOrCreate(array $attributes)
 * @method static Tratamiento|Proxy first(string $sortedField = 'id')
 * @method static Tratamiento|Proxy last(string $sortedField = 'id')
 * @method static Tratamiento|Proxy random(array $attributes = [])
 * @method static Tratamiento|Proxy randomOrCreate(array $attributes = [])
 * @method static TratamientoRepository|RepositoryProxy repository()
 * @method static Tratamiento[]|Proxy[] all()
 * @method static Tratamiento[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Tratamiento[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Tratamiento[]|Proxy[] findBy(array $attributes)
 * @method static Tratamiento[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Tratamiento[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TratamientoFactory extends ModelFactory
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
            'descripcion' => self::faker()->sentence(),
            'nombre' => self::faker()->sentence(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Tratamiento $tratamiento): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Tratamiento::class;
    }
}
