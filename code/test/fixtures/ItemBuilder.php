<?php

namespace Kata;

define("FRESH", 5);
define("NO_QUALITY", 0);
define("NAX_QUALITY", 50);

class ItemBuilder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $sellIn;

    /**
     * @var int
     */
    private $quality;

    /**
     * Construct the ItemBuilder setting sell in and quality to the defaults.
     */
    public function __construct()
    {
        $this->sellIn = FRESH;
        $this->quality = 10;
    }

    /**
     * Set the item to ordinary.
     *
     * @return $this
     */
    public function ordinaryItem()
    {
        return $this->named("any ordinary item");
    }

    /**
     * Set the item to aged brie.
     *
     * @return $this
     */
    public function agedBrie()
    {
        return $this->named("Aged Brie");
    }

    /**
     * Set the item to sulfuras.
     *
     * @return $this
     */
    public function sulfuras()
    {
        return $this->named("Sulfuras, Hand of Ragnaros");
    }

    /**
     * Set the item to backstage pass.
     *
     * @return $this
     */
    public function backstagePass()
    {
        return $this->named("Backstage passes to a TAFKAL80ETC concert");
    }

    /**
     * Set the item to conjured.
     *
     * @return $this
     */
    public function conjuredItem()
    {
        return $this->named("Conjured Mana Cake");
    }

    /**
     * Set the sell in to almost expired.
     *
     * @return $this
     */
    public function almostExpired()
    {
        return $this->withSellIn(1);
    }

    /**
     * Set the sell in to just expired.
     *
     * @return $this
     */
    public function justExpired()
    {
        return $this->withSellIn(0);
    }

    /**
     * Set the sell in to expired.
     *
     * @return $this
     */
    public function expired()
    {
        return $this->withSellIn(-3);
    }

    /**
     * Set the sell in to given number and return a newly built item.
     *
     * @param int $days
     *
     * @return Item
     */
    public function toSellIn($days)
    {
        return $this->withSellIn($days)->item();
    }

    /**
     * Set the sell in to given number.
     *
     * @param int $days
     *
     * @return $this
     */
    public function withSellIn($days)
    {
        $this->sellIn = $days;

        return $this;
    }

    /**
     * Set quality to given number and return newly built item.
     *
     * @param int $number
     *
     * @return Item
     */
    public function ofQuality($number)
    {
        return $this->withQuality($number)->item();
    }

    /**
     * Set quality to none and return newly built item.
     *
     * @return Item
     */
    public function ofNoQuality()
    {
        return $this->withQuality(NO_QUALITY)->item();
    }

    /**
     * Set quality to max and return newly built item.
     *
     * @return Item
     */
    public function ofMaxQuality()
    {
        return $this->withQuality(NAX_QUALITY)->item();
    }

    /**
     * Return the quality
     *
     * @return int
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Return a newly build item.
     *
     * @return Item
     */
    public function item()
    {
        return new Item($this->name, $this->sellIn, $this->quality);
    }

    /**
     * Name the item.
     *
     * @param string $itemName
     *
     * @return $this
     */
    private function named($itemName)
    {
        $this->name = $itemName;

        return $this;
    }

    /**
     * Set the quality of the item.
     *
     * @param int $number
     *
     * @return $this
     */
    private function withQuality($number)
    {
        $this->quality = $number;

        return $this;
    }
}
