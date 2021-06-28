<?php

namespace Services\Views\Traits;

trait CollapsableCards
{
    private $items = [];

    protected function compileCard( $expression )
    {
        $this->items[] = 'CollapsableCard';
        $expression = $this->stripParentheses($expression);
        return $this->phpTag . "echo \$this->collapsableCard($expression) ?>";
    }

    protected function compileEndCard()
    {
        $item = @array_pop( $this->items );
//        if ( $item === null )
//        {
//            $this->showError('@endpanel', 'Missing @card or so many @card', true);
//        }

        return"</div></div></div>";
    }

    protected function collapsableCard( $title = '' )
    {
        $id = uniqid();
        return "<div class='card'>
        <div class='card-header bg-white'>
            <a data-toggle='collapse' href='#collapse-" . $id . "' aria-expanded='true' aria-controls='collapse-" . $id . "' id='heading-" . $id . "' class='d-block'>
                <i class='fa fa-chevron-down pull-right mr-2'></i>
                <h3 style='display: inline;'>$title</h3>
            </a>
        </div>                
        <div id='collapse-" . $id . "' class='collapse show' aria-labelledby='heading-example'>
            <div class='card-body row mt-4'>";

    }
}