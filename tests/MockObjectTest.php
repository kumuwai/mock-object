<?php namespace Kumuwai\MockObject;

use PHPUnit_Framework_TestCase;


class MockObjectTest extends PHPUnit_Framework_TestCase
{
    const CLASS_TO_MOCK = 'Kumuwai\MockObject\MockObject';

    public function tearDown()
    {
        MockObject::close();
    }

    public function testExists()
    {
        $test = new MockObject;
    }

    public function testCanMakeAMockObject()
    {
        $test = new MockObject;
        $result = $test->make(self::CLASS_TO_MOCK);

        $this->assertInstanceOf(self::CLASS_TO_MOCK, $result);
    }

    public function testCanMakeAMockObjectWithStaticMethod()
    {
        $test = MockObject::mock(self::CLASS_TO_MOCK);

        $this->assertInstanceOf(self::CLASS_TO_MOCK, $test);
    }

    public function testCanMockFluentInterface()
    {
        $test = MockObject::mock(self::CLASS_TO_MOCK, ['foo','bar'=>'buzz']);

        $this->assertEquals($test, $test->foo);
        $this->assertEquals('buzz', $test->foo->bar);
        $this->assertEquals('buzz', $test->bar);
        
        $this->assertEquals($test, $test->foo());
        $this->assertEquals('buzz', $test->foo()->bar);
        $this->assertEquals('buzz', $test->foo()->bar());
        $this->assertEquals('buzz', $test->bar());
    }

    /**
     * @expectedException Mockery\Exception\InvalidCountException
     */
    public function testMockeryWillThrowExceptionIfRequiredItemsNotCalled()
    {
        $test = MockObject::mock(self::CLASS_TO_MOCK, [], ['foo','bar'=>'buzz']);
        MockObject::close();
    }

    public function testMockeryWillNotThrowExceptionIfRequiredItemIsCalled()
    {
        $test = MockObject::mock(self::CLASS_TO_MOCK, [], ['bar'=>'buzz']);
        
        $this->assertEquals('buzz', $test->bar());

        MockObject::close();
    }

}

