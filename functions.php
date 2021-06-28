<?php

function config(string $key, $default = null)
{
    return \Miqu\Helpers\env($key, $default);
}
