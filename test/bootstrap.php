<?php
/**
 * Test bootstrap
 */

/**
 * Set the default time zone.
 *
 * @link http://www.php.net/manual/timezones
 */
// Comment the following line if you want relay to the system timezone
// date_default_timezone_set('Europe/Helsinki');


/**
 *  Set the default environment
 *
 *  Possible values are:
 *  Apprunner::DEVELOPMENT
 *  Apprunner::TESTING
 *  Apprunner::PRODUCTION
 */
Apprunner::$environment = Apprunner::DEVELOPMENT;


/**
 * Initialize Apprunner core
 *
 * Optional settings are:
 * - charset (By default 'utf-8')
 *
 * Example:
 * Apprunner:init(['charset'] => 'iso-8859-15');
 */
Apprunner::init();


/**
 * Instance and set attach log writer
 *
 * Some available writers are:
 * - Log_File
 * - Log_StdErr
 * - Log_StdOut
 * - Log_Syslog
 *
 * For Log_File writer is required to set the log directory.
 * Example:
 * Log::instance()->attach(new Log_File('/foo/bar/logs'));
 *
 */
//Log::instance()->attach(new Log_Syslog());
Log::instance()->attach(new Log_StdOut());


/**
 * Load Mamuph modules automatically from Config/Modules.php
 */
/*
Apprunner::modules(
    Arr::merge(
        ['Unittest' => ['path' => TESTPATH . 'Modules'. DS . 'Unittest']], // Add Unittest module
        Config::instance()->load('Modules')->as_array()
    )
);
*/

