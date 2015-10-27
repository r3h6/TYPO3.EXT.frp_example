<?php
namespace Frappant\FrpExample\Tests\Selelenium;

use PHPUnit_Extensions_Selenium2TestCase_Keys AS Keys;

/**
 * @link https://phpunit.de/manual/3.7/en/selenium.html
 * @link http://code.tutsplus.com/tutorials/how-to-use-selenium-2-with-phpunit--net-27577
 * @link https://github.com/giorgiosironi/phpunit-selenium/blob/master/Tests/Selenium2TestCaseTest.php
 */
// class ListViewTest extends \Tx_Phpunit_Selenium_TestCase  {
class ListViewTest extends \PHPUnit_Extensions_Selenium2TestCase {

	protected function setUp(){
		parent::setUp();
		// $this->setBrowser($this->getSeleniumBrowser());
		// $this->setHost($this->getSeleniumHost());
		// $this->setPort($this->getSeleniumPort());
		$this->setBrowser('chrome');
		$this->setHost('192.168.33.10');
		$this->setPort(4444);
		$this->setBrowserUrl('http://typo3-6-2.lamp2/'); // Base url
	}

	/**
	 * @test
	 */
	public function open(){
		// $url = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['frp_example']['seleniumUrl'];
		$url = 'frp-example/';
		$this->url($url);
		$this->assertStringEndsWith($url, $this->url());
	}

	/**
	 * @test
	 * @depends open
	 */
	public function checkSearchFormAndSubmitOneSearchRequest (){
		// Open site.
		// $this->url($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['frp_example']['seleniumUrl']);
		$this->url('frp-example/');

		// Get search form.
		$form = $this->byName('itemDemand');

		// Check search field and fill it.
		$titleInput = $this->byName('tx_frpexample_pi1[itemDemand][title]');
		$this->assertEquals('', $titleInput->value());
		$titleInput->value('Foo');
		$this->assertEquals('Foo', $titleInput->value());

		// Check submit button.
		$submitButton = $this->byCssSelector('form[name="itemDemand"] button[type="submit"]');
		$this->assertNotEmpty($submitButton->text());

		// Submit form
		$form->submit();
	}

	/**
	 * @test
	 * @depends open
	 */
	public function createNewItem (){
		// Open site.
		// $this->url($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['frp_example']['seleniumUrl']);
		$this->url('frp-example/');

		// Click link for creating new element.
		$newLink = $this->byLinkText('New Item');
		$newLink->click();

		// Get form and submit it empty, we expect some validation errors.
		$form = $this->byName('newItem');
		$form->submit();

		// Check validation errors are displayed.
		$this->assertTrue($form->byId('tx_frpexample_pi1[newItem][title]-error')->displayed());
		$this->assertTrue($form->byId('tx_frpexample_pi1[newItem][productionDate][date]-error')->displayed());

		// Fill title.
		$titleInput = $this->byName('tx_frpexample_pi1[newItem][title]');
		$titleInput->value('Test ' . date('H:i'));
		$this->assertFalse($form->byId('tx_frpexample_pi1[newItem][title]-error')->displayed());

		// Go to next field.
		$this->keys(Keys::TAB);

		// Fill date field.
		// $dateInput = $this->byCssSelector(':focus');
		// $dateInput->value(date('Y-m-d'));
		foreach (array(1, 1, 2, 2, 2, 0, 1, 5) as $key){
			$this->keys($key);
		}
		$this->assertFalse($form->byId('tx_frpexample_pi1[newItem][productionDate][date]-error')->displayed());

		// Submit form.
		$form->submit();

		// Check for success message.
		$this->assertContains('The object was created.', $this->source());
	}
}