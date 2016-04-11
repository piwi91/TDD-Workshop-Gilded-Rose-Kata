<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit_Framework_Assert as Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    private $items = [];
    private $foundItems = [];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given there is an item called :name with sell in :sellIn and quality :quality
     */
    public function thereIsAnItem($name, $sellIn, $quality)
    {
        $this->items[] = new \Kata\Item($name, $sellIn, $quality);
    }

    /**
     * @When I search for item :name
     */
    public function iSearchForItem($name)
    {
        $this->foundItems = isset($this->items[$name]) ? [$this->items[$name]] : [];
    }

    /**
     * @Then I should get 1 item returned called :name
     */
    public function iShouldGetItemReturnedCalled($name)
    {
        return Assert::assertTrue(count($this->foundItems) > 0 && $this->foundItems[0]->name == $name);
    }
}
