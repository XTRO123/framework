<?php

namespace App\Modules\System\Controllers\Admin;

use Nova\Auth\Access\AuthorizationException;
use Nova\Support\Facades\Auth;
use Nova\Support\Facades\Gate;
use Nova\Support\Facades\Request;
use Nova\Support\Facades\View;

use App\Controllers\BaseController as Controller;
use App\Modules\System\Support\EventedMenu;


abstract class BaseController extends Controller
{
    /**
     * The currently used Theme.
     *
     * @var string
     */
    protected $theme = 'AdminLite';

    /**
     * The currently used Layout.
     *
     * @var mixed
     */
    protected $layout = 'Backend';


    /**
     * Method executed before any action.
     */
    protected function initialize()
    {
        parent::initialize();

        // Authorize the current User.
        if (Gate::denies('platform.backend.manage')) {
            throw new AuthorizationException();
        }

        $url = Request::url();

        if (! is_null($user = Auth::user())) {
            $navbarItems  = EventedMenu::get('backend.menu.navbar',  $user, $url);
            $sidebarItems = EventedMenu::get('backend.menu.sidebar', $user, $url);
        } else {
            $navbarItems =  array();
            $sidebarItems = array();
        }

        View::share('navbarItems',  $navbarItems);
        View::share('sidebarItems', $sidebarItems);
    }
}
