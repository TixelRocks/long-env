<?php

use Illuminate\Support\Env;

if (! function_exists('long_env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function long_env($key, $default = null)
    {
        if ($value = Env::get($key, $default)) {
            return $value;
        }

        $count = 1;
        $chunks = [];

        while ($count) {
            if (! $value = Env::get($key . ($count++))) break;

            $chunks[] = $value;
        }

        return implode('', $chunks);
    }
}

if (! function_exists('long_env_prepare')) {
    /*
     * @return array
     */
    function long_env_prepare($name, $contents, $chunkLength = 2048)
    {
        $chunks = explode(chr(23), chunk_split($contents, $chunkLength, chr(23)));

        $chunks = array_filter($chunks, function($line) {
            return ! empty($line);
        });

        $output = [];

        foreach ($chunks as $index => $chunk) {
            $number = $index + 1;
            $output["{$name}{$number}"] = $chunk;
        }

        return $output;
    }
}