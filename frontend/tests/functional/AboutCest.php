<?php
namespace frontend\tests;

use frontend\tests\FunctionalTester;

class AboutCest
{
    /**
     * @var \frontend\tests\FunctionalTester
     */
    protected $tester;

    public function checkAbout(FunctionalTester $I)
    {
        $I->amOnRoute('site/about');
        $I->see("TODO: Write some 'about' text", 'h3');
    }
}
