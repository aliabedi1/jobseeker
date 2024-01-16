<?php

if (!function_exists('dda')) {
    function dda(mixed ...$parameters)
    {
        foreach ($parameters as $value)
            dump(($value instanceof Arrayable) ? $value->toArray() : $value);
        exit(1);
    }
}
