<?php declare(strict_types=1);

namespace BattleFight\Test\Domain\Modifier;

use BattleFight\Domain\Modifier\Modifier;
use BattleFight\Domain\Modifier\ModifierInterface;
use PHPUnit\Framework\TestCase;


class ModifierTest extends TestCase
{
    /** @test */
    public function it_creates_modifier()
    {
        $modifier = new Modifier(
            Modifier::BATTLEFIELD_MODIFIER_TYPE,
            Modifier::HEALTH_MODIFIER,
            'tsunami',
            1000,
            3
        );

        $this->assertTrue($modifier instanceof ModifierInterface);
        $this->assertSame(3, $modifier->getChance());
        $this->assertSame(1000, $modifier->getModifyValue());
    }
}
