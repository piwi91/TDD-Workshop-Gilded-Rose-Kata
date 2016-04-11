Feature: Gilded Rose
  In order to buy and sell goods
  As Allison
  I need to add items to the inventory

  Acceptance:
  - An item has a name
  - An item has a SellIn value which denoted the number of days we have to sell the item
  - An item has a Quality value which denotes how valuable the item is

  Scenario: Buying a single product under £10
    Given there is an item called "foo" with sell in "10" and quality "40"
    When I search for item "foo"
    Then I should get 1 item returned called "foo"