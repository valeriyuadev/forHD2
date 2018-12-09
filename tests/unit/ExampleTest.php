<?php
namespace app\tests\unit;

class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _fixtures() {
        return [
            'cash'   => \app\tests\fixtures\CashFixture::class,
        ];
    }

    public function testSomeFeature()
    {
        $cash = $this->tester->grabFixture('cash', 'cash1');

        $this->assertTrue($cash instanceof \app\models\Cash );
        $this->assertEquals(1, $cash->id );

        $bonus = ( new \app\services\ConvertorManager( $cash ) )
            ->getConvertor()
            ->toBonus();

        $this->assertTrue( $bonus instanceof \app\models\Bonus );
        $this->isNull( $bonus->id );
        $this->assertTrue( $bonus->validate() );
        $this->assertTrue( $bonus->save() );
        $this->assertEquals( 3, $bonus->user );
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // $this->_log( $this->_dump( $bonus->attributes ) );
    // $this->_log( $this->_getType( $cash ) );
    private function _getType( $var ) {
        if( is_object( $var ) ) {
            return get_class( $var );
        }

        return gettype( $var );
    }

    private function _log( $mssg ) {
        codecept_debug( $mssg );
    }

    private function _dump( $mssg ) {
        return print_r( $mssg, true );
    }


}