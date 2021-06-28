<?php


namespace Services\Views\Traits;


trait FormBuilder
{
    /**
     * @param $expression
     * @return string
     */
    public function compileDynamicInputs($expression): string
    {
        return $this->phpTag . '
            $builder = new Services\Forms\FormBuilder('. $expression .');
            foreach( $builder->Build() as $group => $collection )
            {
                 print $this->collapsableCard($group);
                    foreach( $collection as $single )
                    {
                        print $single;
                    }
                 print $this->compileEndCard();
            }
        ?>';
    }
}