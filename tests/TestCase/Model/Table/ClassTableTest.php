<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassTable Test Case
 */
class ClassTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClassTable
     */
    public $Class;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.class'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Class') ? [] : ['className' => ClassTable::class];
        $this->Class = TableRegistry::get('Class', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Class);

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
