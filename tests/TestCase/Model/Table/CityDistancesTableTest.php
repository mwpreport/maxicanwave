<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CityDistancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CityDistancesTable Test Case
 */
class CityDistancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CityDistancesTable
     */
    public $CityDistances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.city_distances'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CityDistances') ? [] : ['className' => CityDistancesTable::class];
        $this->CityDistances = TableRegistry::get('CityDistances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CityDistances);

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
