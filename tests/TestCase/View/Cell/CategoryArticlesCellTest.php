<?php
namespace App\Test\TestCase\View\Cell;

use App\View\Cell\CategoryArticlesCell;
use Cake\TestSuite\TestCase;

/**
 * App\View\Cell\CategoryArticlesCell Test Case
 */
class CategoryArticlesCellTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->request = $this->getMock('Cake\Network\Request');
        $this->response = $this->getMock('Cake\Network\Response');
        $this->CategoryArticles = new CategoryArticlesCell($this->request, $this->response);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CategoryArticles);

        parent::tearDown();
    }

    /**
     * Test display method
     *
     * @return void
     */
    public function testDisplay()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
