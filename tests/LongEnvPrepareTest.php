<?php

class LongEnvPrepareTest extends \PHPUnit\Framework\TestCase {
    /**
     * @test
     */
    public function long_string_can_be_split_into_numbered_chunks()
    {
        $input = $this->generateRandomString();
        $chunks = long_env_prepare('MY_ENV', $input, 500);

        $this->assertEquals(ceil(strlen($input) / 500), count($chunks));
        $this->assertTrue(array_key_exists('MY_ENV2', $chunks));
        $this->assertFalse(array_key_exists('MY_ENV6', $chunks));
    }

    /**
     * @param int $length
     * @return false|string
     * From: https://stackoverflow.com/questions/4356289/php-random-string-generator
     */
    public function generateRandomString($length = 2000)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}