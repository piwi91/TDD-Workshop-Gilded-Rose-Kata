<?php

namespace Kata;

class GildedRoseTest extends \PHPUnit_Framework_TestCase {

    function testFoo() {
        $items = array(new Item("foo", 0, 0));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals("fixme", $items[0]->name);
    }

    function testFooMatcher() {
        $items = array(new Item("foo", 0, 0));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertThat($items[0]->name, $this->equalTo("fixme"));
    }
}
