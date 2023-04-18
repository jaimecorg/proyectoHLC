<?php

namespace App\Factory;

use App\Entity\Cita;
use App\Repository\CitaRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Cita>
 *
 * @method        Cita|Proxy create(array|callable $attributes = [])
 * @method static Cita|Proxy createOne(array $attributes = [])
 * @method static Cita|Proxy find(object|array|mixed $criteria)
 * @method static Cita|Proxy findOrCreate(array $attributes)
 * @method static Cita|Proxy first(string $sortedField = 'id')
 * @method static Cita|Proxy last(string $sortedField = 'id')
 * @method static Cita|Proxy random(array $attributes = [])
 * @method static Cita|Proxy randomOrCreate(array $attributes = [])
 * @method static CitaRepository|RepositoryProxy repository()
 * @method static Cita[]|Proxy[] all()
 * @method static Cita[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Cita[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Cita[]|Proxy[] findBy(array $attributes)
 * @method static Cita[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Cita[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CitaFactory extends ModelFactory
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
            'fecha' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Cita $cita): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Cita::class;
    }
}
