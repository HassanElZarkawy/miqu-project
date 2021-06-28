<?php

namespace Services\Validation\Interfaces;

interface IRequestValidator
{
    function validate() : bool;
}