<?php
/**
 * Events - all Module's specific Events are defined here.
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 4.0
 */


/** Define Events. */

Event::listen('backend.menu', function($user)
{
    if ($user->hasRole('administrator')) {
        $items = array(
            array(
                'uri'    => 'admin/files',
                'title'  => __d('files', 'Files'),
                'label'  => '',
                'icon'   => 'file',
                'weight' => 3,
            ),
        );
    } else {
        $items = array();
    }

    return $items;
});
