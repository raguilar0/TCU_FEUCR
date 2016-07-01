<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AmountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AmountsTable Test Case
 */
class AmountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AmountsTable
     */
    public $Amounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.amounts',
        'app.associations',
        'app.headquarters',
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
        $config = TableRegistry::exists('Amounts') ? [] : ['className' => 'App\Model\Table\AmountsTable'];
        $this->Amounts = TableRegistry::get('Amounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Amounts);

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
