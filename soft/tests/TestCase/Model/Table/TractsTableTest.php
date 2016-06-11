<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TractsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TractsTable Test Case
 */
class TractsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TractsTable
     */
    public $Tracts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tracts',
        'app.amounts',
        'app.associations',
        'app.headquarters',
        'app.boxes',
        'app.invoices',
        'app.initial_amounts',
        'app.surpluses',
        'app.warehouses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tracts') ? [] : ['className' => 'App\Model\Table\TractsTable'];
        $this->Tracts = TableRegistry::get('Tracts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tracts);

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
}
