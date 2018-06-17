<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpenseTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpenseTypesTable Test Case
 */
class ExpenseTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpenseTypesTable
     */
    public $ExpenseTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expense_types',
        'app.daily_allowances'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExpenseTypes') ? [] : ['className' => ExpenseTypesTable::class];
        $this->ExpenseTypes = TableRegistry::get('ExpenseTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExpenseTypes);

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
