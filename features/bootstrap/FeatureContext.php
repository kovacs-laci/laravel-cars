<?php

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

class FeatureContext implements Context
{
    /**
     * @Given I am on the homepage
     */
    public function iAmOnTheHomepage()
    {
        $this->visitPath('/');
    }

    /**
     * @When I follow :link
     */
    public function iFollow($link)
    {
        $this->clickLink($link);
    }

    /**
     * @Then I should be on :path
     */
    public function iShouldBeOn($path)
    {
        $currentPath = $this->getSession()->getCurrentUrl();
        Assert::assertStringEndsWith($path, $currentPath);
    }

    /**
     * @Then I should see the heading :heading
     */
    public function iShouldSeeTheHeading($heading)
    {
        $headingText = $this->getSession()->getPage()->find('css', 'h1')->getText();
        Assert::assertEquals($heading, $headingText, "Expected heading '$heading' not found.");
    }

    /**
     * @Then I should see a list of makers
     */
    public function iShouldSeeAListOfMakers()
    {
        $makersList = $this->getSession()->getPage()->findAll('css', 'ul > li.row');
        Assert::assertNotEmpty($makersList, 'Makers list not found or is empty.');
    }
}
