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

    // [1a, 3a] Sell In & Of Quality
    public function test_sell_in_and_quality_will_never_be_lowered_for_sulfuras()
    {
        $item = $this->itemBuilder->sulfuras()->withSellIn(5)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatSellInIs(5, $item);
        $this->assertThatQualityIs(10, $item);
    }

    // [4a, 2a] Expired & Of Quality
    public function test_quality_is_not_degraded_for_expired_sulfuras()
    {
        $item = $this->itemBuilder->justExpired()->sulfuras()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(10, $item);
    }

    // [1a]
    public function test_lower_sell_in_and_upper_quality_for_backstage_pass()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(20)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatSellInIs(19, $item);
        $this->assertThatQualityIs(11, $item);
    }

    // increase quality by 2 when sell in is 10 days or less
    public function test_quality_increases_twice_as_fast_for_backstage_pass_with_sell_in_lower_then_10()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(8)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(12, $item);
    }

    // increase quality by 2 when sell in is 10 days (boundary)
    public function test_quality_increases_twice_as_fast_for_backstage_pass_with_sell_in_10()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(10)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(12, $item);
    }

    // increase quality by 3 when sell in is 5 days or less
    public function test_quality_increases_3_times_as_fast_for_backstage_pass_with_sell_in_lower_then_5()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(3)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(13, $item);
    }

    // increase quality by 3 when sell in is 5 days (boundary)
    public function test_quality_increases_3_times_as_fast_for_backstage_pass_with_sell_in_5()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(3)->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(13, $item);
    }

    // quality drops to zero when expired
    public function test_quality_drops_to_zero_for_expired_backstage_pass()
    {
        $item = $this->itemBuilder->expired()->backstagePass()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(0, $item);
    }

    // boundary
    public function test_quality_increases_for_almost_expired_backstage_pass()
    {
        $item = $this->itemBuilder->almostExpired()->backstagePass()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(13, $item);
    }

    public function test_quality_drops_to_zero_for_just_expired_backstage_pass()
    {
        $item = $this->itemBuilder->justExpired()->backstagePass()->ofQuality(10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(0, $item);
    }

    public function test_quality_hits_50_for_backstage_pass_with_almost_max_quality()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(20)->ofQuality(49);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    public function test_quality_is_50_for_backstage_pass_with_max_quality()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(8)->ofMaxQuality();
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    public function test_quality_increases_with_one_for_backstage_pass_with_sell_in_lower_then_10()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(8)->ofQuality(49);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    public function test_quality_hits_50_for_backstage_pass_with_sell_in_lower_then_10()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(8)->ofQuality(48);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    public function test_quality_is_50_for_almost_expired_backstage_pass_with_max_quality()
    {
        $item = $this->itemBuilder->almostExpired()->backstagePass()->ofMaxQuality();
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    public function test_quality_increases_with_one_for_backstage_pass_with_sell_in_lower_then_5()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(3)->ofQuality(49);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    public function test_quality_increases_with_two_for_backstage_pass_with_sell_in_lower_then_5()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(3)->ofQuality(48);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->update_quality();

        $this->assertThatQualityIs(50, $item);
    }

    public function test_quality_hits_50_for_backstage_pass_with_sell_in_lower_then_5()
    {
        $item = $this->itemBuilder->backstagePass()->withSellIn(3)->ofQuality(47);
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
