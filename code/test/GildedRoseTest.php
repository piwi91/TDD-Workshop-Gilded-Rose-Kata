<?php

namespace Kata;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ItemBuilder
     */
    protected $itemBuilder;

    protected function setUp()
    {
        $this->itemBuilder = new ItemBuilder();
    }

    public function test_lower_sell_in_and_quality_for_ordinary_item()
    {
        $item = $this->itemBuilder->ordinaryItem()->withSellIn(5)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);
        $gildedRose->update_quality();
        $this->assertEquals(9, $item->quality);
        $this->assertEquals(4, $item->sell_in);
    }
}
