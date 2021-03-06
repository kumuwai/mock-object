<?php namespace Kumuwai\MockObject;

use Mockery;

/**
 * Return a mocked object, with a simpler syntax.
 * To use:
 *
 * ```php
 * $obj = MockObject::mock(
 *     'MockedObject',
 *     ['a','b','foo'=>'bar']
 * );
 * ```
 */
class MockObject
{
    /**
     * Static shortcut to MockObject::make().
     * 
     * @param  string $interface     Class or interface to mock
     * @param  array  $expectations  Methods or properties that may be called
     * @param  array  $requirements  Methods that must be called (or an error will be thrown)
     * 
     * @return \Mockery\MockInterface
     */
    public static function mock($interface, array $expectations=array(), array $requirements=array())
    {
        return (new self)->make($interface, $expectations, $requirements);
    }

    /**
     * Create a mock object
     *
     * @param  string $interface     Class or interface to mock
     * @param  array  $expectations  Methods or properties that may be called
     * @param  array  $requirements  Methods that must be called (or an error will be thrown)
     * 
     * @return \Mockery\MockInterface
     */
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

    /**
     * Static shortcut to closing and verifying all mocked objects
     *
     * @return void
     */
    public static function close()
    {
        Mockery::close();
    }
}
