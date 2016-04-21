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

    // [1a] Sell In & Of Quality
    public function test_lower_sell_in_and_quality_for_ordinary_item()
    {
        $item = $this->itemBuilder->ordinaryItem()->withSellIn(5)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatSellInIs(4, $item);
        $this->assertThatQualityIs(9, $item);
    }

    // [2a] Just expired & Of Quality
    // Boundary
    public function test_quality_degrades_twice_as_fast_for_just_expired_ordinary_item()
    {
        $item = $this->itemBuilder->justExpired()->ordinaryItem()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(8, $item);
    }

    // [3a] Almost expired & Of Quality
    // Boundary
    public function test_quality_degrades_normally_for_almost_expired_ordinary_item()
    {
        $item = $this->itemBuilder->almostExpired()->ordinaryItem()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(9, $item);
    }

    // [4a] Expired & Of Quality
    public function test_quality_degrades_twice_as_fast_for_expired_ordinary_item()
    {
        $item = $this->itemBuilder->expired()->ordinaryItem()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(8, $item);
    }

    // [1c, 2c, 3c, 4c] No Quality
    public function test_quality_will_not_degrade_below_50_for_ordinary_item()
    {
        $item = $this->itemBuilder->ordinaryItem()->withSellIn(5)->ofNoQuality();
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(0, $item);
    }

    /** Helper methods */
    private function assertThatSellInIs($value, Item $item)
    {
        $this->assertEquals($item->sell_in, $value);
    }

    private function assertThatQualityIs($value, Item $item)
    {
        $this->assertEquals($item->quality, $value);
    }
}
