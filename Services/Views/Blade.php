<?php /** @noinspection PhpUnused */

namespace Services\Views;

use Miqu\Core\Interfaces\IViewEngine;
use eftec\bladeone\BladeOne;
use Services\Security\Admin\Contracts\IAuthorizationManager;
use Services\Views\Traits\CollapsableCards;
use Services\Views\Traits\FormBuilder;
use Services\Views\Traits\FormTokens;
use Services\Views\Traits\ViewFiles;

class Blade extends BladeOne implements IViewEngine
{
    use CollapsableCards, FormTokens, ViewFiles, FormBuilder;

    /** @var IAuthorizationManager */
    public $authorizationManager;

    public function __construct( IAuthorizationManager $authorizationManager )
    {

        $views_base_path = BASE_DIRECTORY . \Miqu\Helpers\env('blade.views_path');
        
        $blade_compile_path = BASE_DIRECTORY . \Miqu\Helpers\env('blade.bin_path');
    
        $blade_mode = \Miqu\Helpers\env('blade.mode');

        parent::__construct( $views_base_path, $blade_compile_path, $blade_mode );

        $this->authorizationManager = $authorizationManager;

        $this->setAuthorizationPolicy();

        $this->setErrorCallback();
    }

    /**
     * @return string
     */
    public function compileDatatableStyles(): string
    {
        return '
            <link rel="stylesheet" href="'.asset( 'datatables/css/bundle.min.css' ).'">
            <link rel="stylesheet" href="'.asset( 'datatables/css/datatable.editor.min.css' ).'">
        ';
    }

    /**
     * @return string
     */
    public function compileDatatableScripts(): string
    {
        return '
                <script src="'.asset( 'datatables/js/pdfmake.min.js' ).'"></script>
                <script src="'.asset( 'datatables/js/vfs_fonts.min.js' ).'"></script>
                <script src="'.asset( 'datatables/js/bundle.min.js' ).'"></script>
                <script src="'.asset( 'js/datatables.editor.js' ).'"></script>
        ';
    }

    private function setAuthorizationPolicy() : void
    {
        $this->setCanFunction(function( $action ) {
            return $this->authorizationManager->Can( $action );
        });
    }

    private function setErrorCallback()
    {
        $this->setErrorFunction(function($key) {
            if ( count( $this->variables ) === 0 )
                return false;

            if ( ! isset( $this->variables[ 'errors' ] ) )
                return false;

            if ( ! isset( $this->variables[ 'errors' ][ $key ] ) )
                return false;

            return true;
        });
    }
}