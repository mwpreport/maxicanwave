<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DailyAllowancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DailyAllowancesTable Test Case
 */
class DailyAllowancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DailyAllowancesTable
     */
    public $DailyAllowances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.daily_allowances',
        'app.expense_types',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DailyAllowances') ? [] : ['className' => DailyAllowancesTable::class];
        $this->DailyAllowances = TableRegistry::get('DailyAllowances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DailyAllowances);

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
