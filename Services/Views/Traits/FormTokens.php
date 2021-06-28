<?php

namespace Services\Views\Traits;

trait FormTokens
{
    protected function compileCsrf( $expression = null ): string
    {
        return $this->phpTag . "echo \csrf() ?>";
    }
}