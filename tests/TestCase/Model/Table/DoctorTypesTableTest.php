<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DoctorTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DoctorTypesTable Test Case
 */
class DoctorTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DoctorTypesTable
     */
    public $DoctorTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.doctor_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DoctorTypes') ? [] : ['className' => DoctorTypesTable::class];
        $this->DoctorTypes = TableRegistry::get('DoctorTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DoctorTypes);

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
