<?php

/*
 * This file is part of the Fidry\AliceDataFixtures package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Fidry\AliceDataFixtures\Bridge\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;

/**
 * @covers \Fidry\AliceDataFixtures\Bridge\Symfony\DependencyInjection\Configuration
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultValues()
    {
        $configuration = new Configuration();
        $processor = new Processor();
        $expected = [
            'db_drivers' => [
                'doctrine_orm' => null,
                'eloquent_orm' => null,
            ],
        ];
        $actual = $processor->processConfiguration($configuration, []);
        $this->assertEquals($expected, $actual);
    }

    public function testDefaultValuesCanBeOverridden()
    {
        $configuration = new Configuration();
        $processor = new Processor();
        $expected = [
            'db_drivers' => [
                'doctrine_orm' => true,
                'eloquent_orm' => false,
            ],
        ];
        $actual = $processor->processConfiguration(
            $configuration,
            [
                'fidry_alice_data_fixtures' => [
                    'db_drivers' => [
                        'doctrine_orm' => true,
                        'eloquent_orm' => false,
                    ],
                ],
            ]
        );
        $this->assertEquals($expected, $actual);
    }
}
