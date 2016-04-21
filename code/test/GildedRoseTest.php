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
    public function test_quality_will_not_degrade_below_0_for_ordinary_item()
    {
        $item = $this->itemBuilder->ordinaryItem()->ofNoQuality();
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(0, $item);
    }

    // [1c, 2c, 3c, 4c] No Quality
    public function test_quality_will_not_degrade_below_0_for_expired_ordinary_item()
    {
        $item = $this->itemBuilder->expired()->ordinaryItem()->ofNoQuality();
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(0, $item);
    }

    // Boundary
    public function test_quality_hits_zero_for_ordinary_item()
    {
        $item = $this->itemBuilder->ordinaryItem()->ofQuality(1);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(0, $item);
    }

    // Boundary
    public function test_quality_hits_zero_for_expired_ordinary_item_with_one_quality()
    {
        $item = $this->itemBuilder->expired()->ordinaryItem()->ofQuality(1);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(0, $item);
    }

    // Boundary
    public function test_quality_hits_zero_for_expired_ordinary_item()
    {
        $item = $this->itemBuilder->expired()->ordinaryItem()->ofQuality(2);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(0, $item);
    }

    // [1a] Sell In & Of Quality
    public function test_lower_sell_in_and_upper_quality_for_aged_brie()
    {
        $item = $this->itemBuilder->agedBrie()->withSellIn(10)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatSellInIs(9, $item);
        $this->assertThatQualityIs(11, $item);
    }

    // [2a] Just expired & Of Quality
    // Boundary
    public function test_quality_increases_twice_as_fast_for_just_expired_aged_brie()
    {
        $item = $this->itemBuilder->justExpired()->agedBrie()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(12, $item);
    }

    // [3a] Almost expired & Of Quality
    // Boundary
    public function test_quality_increases_normally_for_almost_expired_aged_brie()
    {
        $item = $this->itemBuilder->almostExpired()->agedBrie()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(11, $item);
    }

    // [4a] Expired & Of Quality
    public function test_quality_increases_twice_as_fast_for_expired_aged_brie()
    {
        $item = $this->itemBuilder->expired()->agedBrie()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(12, $item);
    }

    // [1c, 2c, 3c, 4c] Max Quality
    public function test_quality_will_not_increase_above_50_for_max_quality_aged_brie()
    {
        $item = $this->itemBuilder->agedBrie()->ofMaxQuality();
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    // [1c, 2c, 3c, 4c] Max Quality
    public function test_quality_will_not_increase_above_50_for_max_quality_expired_aged_brie()
    {
        $item = $this->itemBuilder->expired()->agedBrie()->ofMaxQuality();
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    // Boundary
    public function test_quality_will_increase_with_one_for_almost_max_quality_aged_brie()
    {
        $item = $this->itemBuilder->agedBrie()->ofQuality(49);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    // Boundary
    public function test_quality_will_increase_with_one_for_expired_aged_brie()
    {
        $item = $this->itemBuilder->expired()->agedBrie()->ofQuality(49);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    // Boundary
    public function test_quality_will_hit_50_for_expired_aged_brie()
    {
        $item = $this->itemBuilder->expired()->agedBrie()->ofQuality(48);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
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
