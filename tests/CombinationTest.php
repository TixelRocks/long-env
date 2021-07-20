<?php

class CombinationTest extends \PHPUnit\Framework\TestCase {
    /**
     * @test
     */
    public function multiline_file_can_be_set_as_env_and_then_read()
    {
        $contents = file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'test.key');
        $chunks = long_env_prepare('SUPER_KEY', $contents, 20);

        $this->assertEquals(ceil(strlen($contents) / 20), count($chunks));

        foreach ($chunks as $name => $value) {
            putenv("{$name}={$value}");
        }

        $reconstructed = long_env('SUPER_KEY');
        $this->assertEquals($contents, $reconstructed);
    }
}