<?php
if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed $args
     *
     * @return void
     */
    function dd(...$args)
    {
        http_response_code(500);

        dump(...$args);

        die(1);
    }
}

if (!function_exists('dump')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed $args
     *
     * @return void
     */
    function dump(...$args)
    {
        foreach ($args as $arg) {
            \yii\helpers\VarDumper::dump($arg, 10, true);
            echo '<br>';
        }
    }
}


if (!function_exists('array_first')) {
    /**
     * Get first element of array
     *
     * @param $array
     * @param null $default
     *
     * @return null
     */
    function array_first($array, $default = null)
    {
        if (empty($array)) {
            return $default;
        }

        foreach ($array as $item) {
            return $item;
        }
    }
}

if (!function_exists('array_last')) {
    /**
     * Get last element of array
     *
     * @param $array
     * @param null $default
     *
     * @return null
     */
    function array_last($array, $default = null)
    {
        return array_first(array_reverse($array, true), $default);
    }
}

