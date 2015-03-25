<?php namespace Kumuwai\MockObject;

use Mockery;

/**
 * Return a mocked object, with a simpler syntax.
 * To use:
 *
 * $obj = MockObject::mock(
 *     'MockedObject',
 *     ['a','b','foo'=>'bar']
 * );
 */
class MockObject
{
    public static function mock($interface, array $expectations=array(), array $requirements=array())
    {
        return (new self)->make($interface, $expectations, $requirements);
    }

    public function make($interface, array $expectations=array(), array $requirements=array())
    {
        $mock = Mockery::mock($interface);

        foreach($expectations as $key=>$value)
            if (! is_numeric($key)) {
                $mock->shouldReceive($key)->byDefault()->andReturn($value);
                $mock->$key = $value;
            }
            else {
                $mock->shouldReceive($value)->byDefault()->andReturn($mock);
                $mock->$value = $mock;
            }

        foreach($requirements as $key=>$value)
            if (! is_numeric($key)) {
                $mock->shouldReceive($key)->atLeast()->once()->andReturn($value);
                $mock->$key = $value;
            }
            else {
                $mock->shouldReceive($value)->atLeast()->once()->andReturn($mock);
                $mock->$value = $mock;
            }

        return $mock;
    }

    public static function close()
    {
        Mockery::close();
    }
}
