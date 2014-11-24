<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

// Autoloading Classes Files
spl_autoload_register(function($sClass)
{
    // Hack to remove namespace and backslash
    $sClass = str_replace(array(__NAMESPACE__ . '\\', '\\'), '/', $sClass);

    /*** For Main module ***/
    if (is_file(H2O_SERVER_PATH . 'app/modules/main/classes' . $sClass . '.php'))
        require_once H2O_SERVER_PATH . 'app/modules/main/classes' . $sClass . '.php';

    if (is_file(H2O_SERVER_PATH . 'app/modules/main/forms' . $sClass . '.php'))
        require_once H2O_SERVER_PATH . 'app/modules/main/forms' . $sClass . '.php';

    if (is_file(H2O_SERVER_PATH . 'app/modules/main/models' . $sClass . '.php'))
        require_once H2O_SERVER_PATH . 'app/modules/main/models' . $sClass . '.php';


    /*** For other modules ***/
    // Get module name
    $sMod = Application::getModule();

    if (is_file(H2O_SERVER_PATH . 'app/modules/' . $sMod . '/controllers' . $sClass . '.php'))
        require_once H2O_SERVER_PATH . 'app/modules/' . $sMod . '/controllers' . $sClass . '.php';

    if (is_file(H2O_SERVER_PATH . 'app/modules/' . $sMod . '/models' . $sClass . '.php'))
        require_once H2O_SERVER_PATH . 'app/modules/' . $sMod . '/models' . $sClass . '.php';

    if (is_file(H2O_SERVER_PATH . 'app/modules/' . $sMod . '/classes' . $sClass . '.php'))
        require_once H2O_SERVER_PATH . 'app/modules/' . $sMod . '/classes' . $sClass . '.php';

    if (is_file(H2O_SERVER_PATH . 'app/modules/' . $sMod . '/forms' . $sClass . '.php'))
        require_once H2O_SERVER_PATH . 'app/modules/' . $sMod . '/forms' . $sClass . '.php';

    if (is_file(H2O_SERVER_PATH . 'app/modules/' . $sMod . '/forms/process' . $sClass . '.php'))
        require_once H2O_SERVER_PATH . 'app/modules/' . $sMod . '/forms/process' . $sClass . '.php';
});