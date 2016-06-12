<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SurplusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SurplusesTable Test Case
 */
class SurplusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SurplusesTable
     */
    public $Surpluses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.surpluses',
        'app.associations',
        'app.headquarters',
        'app.amounts',
        'app.boxes',
        'app.invoices',
        'app.initial_amounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Surpluses') ? [] : ['className' => 'App\Model\Table\SurplusesTable'];
        $this->Surpluses = TableRegistry::get('Surpluses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Surpluses);

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
