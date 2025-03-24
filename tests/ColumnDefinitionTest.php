<?php

namespace mrugeshtatvasoft\DataTables\Html\Tests;

use mrugeshtatvasoft\DataTables\Html\ColumnDefinition;
use PHPUnit\Framework\Attributes\Test;

class ColumnDefinitionTest extends TestCase
{
    #[Test]
    public function it_has_property_setters()
    {
        $def = ColumnDefinition::make()
            ->targets([1])
            ->columns([])
            ->cellType()
            ->className('my-class')
            ->contentPadding('mmm')
            ->createdCell('fn');

        $this->assertEquals([1], $def->targets);
        $this->assertEquals([], $def->columns);
        $this->assertEquals('th', $def->cellType);
        $this->assertEquals('my-class', $def->className);
        $this->assertEquals('mmm', $def->contentPadding);
        $this->assertEquals('fn', $def->createdCell);
    }
}
