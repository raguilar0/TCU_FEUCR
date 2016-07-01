<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SavingAccountsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SavingAccountsController Test Case
 */
class SavingAccountsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.saving_accounts',
        'app.associations',
        'app.headquarters',
        'app.amounts',
        'app.boxes',
        'app.invoices',
        'app.initial_amounts',
        'app.tracts',
        'app.warehouses',
        'app.surpluses',
        'app.savings'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
