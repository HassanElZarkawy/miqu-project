<?php

namespace Services\Views\Traits;

trait ViewFiles
{
    /**
     * @param $expression
     * @return string
     */
    public function compileFileBaseName($expression ): string
    {
        return $this->phpTag . " echo \basename($expression) ?>";
    }
}