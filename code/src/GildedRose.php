<?php

namespace Kata;

class GildedRose
{
    const PRODUCT_AGED_BRIE = 'Aged Brie';
    const PRODUCT_BACKSTAGE_PASS = 'Backstage passes to a TAFKAL80ETC concert';
    const PRODUCT_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    /**
     * @var Item[]
     */
    private $items;

    /**
     * @param Item[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Update the quality of the items given while initialization this class.
     */
    public function update_quality()
    {
        foreach ($this->items as $item) {
            $this->updateItem($item);
        }
    }

    /**
     * Update the quality of a single item.
     *
     * @param Item $item
     */
    private function updateItem(Item $item)
    {
        // Sulfuras is not subject to quality changes and has never to be sold
        if ($this->isProduct($item, self::PRODUCT_SULFURAS)) {
            return;
        }

        // Decrease quality if the items is nothing specials
        if ($this->isOrdinaryItem($item)) {
            $this->decreaseQuality($item);
        } else {
            // Increase quality for aged brie and backstage pass
            $this->increaseQuality($item);

            if ($this->isProduct($item, self::PRODUCT_BACKSTAGE_PASS)) {
                // Increase quality twice as fast for backstage passes with a sell in value of 10 or lower
                if ($this->isSellInLowerThen($item, 11)) {
                    $this->increaseQuality($item);
                }
                // Increase quality three times as fast for backstage passes with a sell in value of 5 or lower
                if ($this->isSellInLowerThen($item, 6)) {
                    $this->increaseQuality($item);
                }
            }
        }

        // Decrease sell in value for all items
        $this->decreaseSellIn($item);

        if ($this->isSellInLowerThen($item, 0)) {
            switch ($item->name) {
                case self::PRODUCT_AGED_BRIE:
                    // Increase quality twice as fast for aged brie
                    $this->increaseQuality($item); break;
                case self::PRODUCT_BACKSTAGE_PASS:
                    // Set quality to zero if backstage pass is expired
                    $this->setQualityToZero($item); break;
                default:
                    // All other items should be decreased in quality
                    $this->decreaseQuality($item); break;
            }
        }
    }

    /**
     * Return if the given item equalizes one or more product name(s).
     *
     * @param Item $item
     * @param string|array $name
     *
     * @return bool
     */
    private function isProduct(Item $item, $name)
    {
        if (is_array($name)) {
            foreach ($name as $row) {
                if ($this->isProduct($item, $row)) {
                    return true;
                }
            }

            return false;
        } else {
            return $item->name === $name;
        }
    }

    /**
     * Return if given item is an ordinary item.
     *
     * @param Item $item
     *
     * @return bool
     */
    private function isOrdinaryItem(Item $item)
    {
        return !$this->isProduct($item, [self::PRODUCT_AGED_BRIE, self::PRODUCT_BACKSTAGE_PASS, self::PRODUCT_SULFURAS]);
    }

    /**
     * Return if item's qualty is greater then the given integer value.
     *
     * @param Item $item
     * @param int $value
     *
     * @return bool
     */
    private function isQualityGreaterThen(Item $item, $value)
    {
        return $item->quality > $value;
    }

    /**
     * Return if item's quality is lower then the given integer value.
     *
     * @param Item $item
     * @param int $value
     *
     * @return bool
     */
    private function isQualityLowerThen(Item $item, $value)
    {
        return $item->quality < $value;
    }

    /**
     * Return if item's sell in is lower then the given integer value.
     *
     * @param Item $item
     * @param int $value
     *
     * @return bool
     */
    private function isSellInLowerThen(Item $item, $value)
    {
        return $item->sell_in < $value;
    }

    /**
     * Decrease quality by one.
     *
     * @param Item $item
     */
    private function decreaseQuality(Item $item)
    {
        if ($this->isQualityGreaterThen($item, 0)) {
            $item->quality--;
        }
    }

    /**
     * Increase quality by one.
     *
     * @param Item $item
     */
    private function increaseQuality(Item $item)
    {
        if ($this->isQualityLowerThen($item, 50)) {
            $item->quality++;
        }
    }

    /**
     * Set quality to zero.
     *
     * @param Item $item
     */
    private function setQualityToZero(Item $item)
    {
        $item->quality = 0;
    }

    /**
     * Decrease sell in by one.
     *
     * @param Item $item
     */
    private function decreaseSellIn(Item $item)
    {
        $item->sell_in--;
    }
}
