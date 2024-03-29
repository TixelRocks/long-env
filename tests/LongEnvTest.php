<?php

class LongEnvTest extends \PHPUnit\Framework\TestCase {
    /**
     * @test
     */
    public function if_a_variable_exists_its_value_is_returned()
    {
        putenv("TEST=123");

        $this->assertEquals('123', long_env('TEST'));
    }

    /**
     * @test
     */
    public function if_numbered_chunks_exist_they_are_returned_combined()
    {
        putenv("TEST1=123");
        putenv("TEST2=456");
        putenv("TEST5=789");

        $this->assertEquals('123456', long_env('TEST'));
    }

    /**
     * @test
     */
    public function matching_name_is_preferred_over_chunks()
    {
        putenv("TEST=NAH");

        putenv("TEST1=123");
        putenv("TEST2=456");

        $this->assertEquals('NAH', long_env('TEST'));
    }

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        putenv("TEST");
    }
}