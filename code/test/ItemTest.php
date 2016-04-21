<?php

namespace Kata;

class ItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ItemBuilder
     */
    protected $itemBuilder;

    protected function setUp()
    {
        $this->itemBuilder = new ItemBuilder();
    }

    public function test_all_items_have_a_name()
    {
        $this->assertClassHasAttribute('name', Item::class);
    }

    public function test_all_items_have_a_sell_in_value()
    {
        $this->assertClassHasAttribute('sell_in', Item::class);
    }

    public function test_all_items_have_a_quality_value()
    {
        $this->assertClassHasAttribute('quality', Item::class);
    }
}
