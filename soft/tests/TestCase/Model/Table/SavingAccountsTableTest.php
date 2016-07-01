<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SavingAccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SavingAccountsTable Test Case
 */
class SavingAccountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SavingAccountsTable
     */
    public $SavingAccounts;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SavingAccounts') ? [] : ['className' => 'App\Model\Table\SavingAccountsTable'];
        $this->SavingAccounts = TableRegistry::get('SavingAccounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SavingAccounts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
