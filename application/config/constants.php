<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// api access and version
defined('API_URL')                                  OR define('API_URL'         , $_ENV['API_URL']);

defined("META_DEFAULT_PAGE_TITLE")                  OR define("META_DEFAULT_PAGE_TITLE", $_ENV['DEFAULT_PAGE_TITLE']);


defined("DEFAULT_NUM_ROWS")                         OR define("DEFAULT_NUM_ROWS", 25);
defined("MAX_NUM_ROWS")                             OR define("MAX_NUM_ROWS", 999999);


defined("FN_DELIMITER")                             OR define("FN_DELIMITER", "---");
defined("MD5_DELIMITER")                            OR define("MD5_DELIMITER", "___");

defined("NAV_POSITION_RIGHT")                       OR define("NAV_POSITION_RIGHT"  , "right");
defined("NAV_POSITION_LEFT")                        OR define("NAV_POSITION_LEFT"   , "left");


defined("SHORT_DATE_FORMAT")                        OR define("SHORT_DATE_FORMAT"  , "m/d/Y");
defined("TIME_FORMAT")                              OR define("TIME_FORMAT", "g:i a T");
defined("LONG_DATE_FORMAT")                         OR define("LONG_DATE_FORMAT", "l, F jS, Y g:i:s A");
defined("LOG_DATE_FORMAT")                          OR define("LOG_DATE_FORMAT", "l, F jS, Y g:i:s A");
defined("NOTE_DATE_FORMAT")                         OR define("NOTE_DATE_FORMAT", "m/d/Y h:i");
defined("DB_DATE_FORMAT")                           OR define("DB_DATE_FORMAT", "Y-m-d");
// max file size
defined("MAX_FILE_SIZE")                            OR define("MAX_FILE_SIZE", 4028000);

// define sorting direction
defined("LIST_SORT_ASC")                            OR define("LIST_SORT_ASC", "asc");
defined("LIST_SORT_DESC")                           OR define("LIST_SORT_DESC", "desc");


defined('API_VERSION')                              OR define('API_VERSION'         , $_ENV['API_VERSION']);
defined("APP_VERSION")                              OR define("APP_VERSION"         , $_ENV['APP_VERSION'] ?? "1.0.0");
defined("ASSETS_VERSION")                           OR define("ASSETS_VERSION"      , $_ENV['ASSETS_VERSION'] ?? "r001");

defined("IS_DEV")                                   OR define("IS_DEV", "development" === $_ENV['ENVIRONMENT']);

// default to english
defined('LANG_EN') OR define('LANG_EN', 1);
defined('DEFAULT_LANG') OR define('DEFAULT_LANG', LANG_EN);
defined('DEFAULT_PASSWORD') OR define('DEFAULT_PASSWORD', $_ENV['DEFAULT_PASSWORD'] ?? "S3cur3dp@ssw0rd");
defined('DF_PROFILE_IMAGE_EXT') OR define('DF_PROFILE_IMAGE_EXT', $_ENV['DF_PROFILE_IMAGE_EXT'] ?? '.jpg');

// config
defined("ACTION_CONFIG_GET")                    OR define("ACTION_CONFIG_GET"               , "/config/item");

//////email settings
defined("EMAIL_FROM")                       OR define("EMAIL_FROM"     , $_ENV['EMAIL_FROM'] ?? "");
defined("EMAIL_FROM_NAME")                  OR define("EMAIL_FROM_NAME", $_ENV["EMAIL_FROM_NAME"] ?? "");
defined("EMAIL_SMTP_HOST")                  OR define("EMAIL_SMTP_HOST", $_ENV['SMTP_HOST'] ?? "");
defined("EMAIL_SMTP_PORT")                  OR define("EMAIL_SMTP_PORT", $_ENV['SMTP_PORT'] ?? "");
defined("EMAIL_SMTP_USERNAME")              OR define("EMAIL_SMTP_USERNAME", $_ENV['SMTP_USERNAME'] ?? "");
defined("EMAIL_SMTP_PASSWORD")              OR define("EMAIL_SMTP_PASSWORD", $_ENV['SMTP_PASSWORD'] ?? "");


defined("USER_STATUS_PUBLISH")              OR define("USER_STATUS_PUBLISH"      , 1);
defined("USER_STATUS_UNPUBLISH")            OR define("USER_STATUS_UNPUBLISH"    , 2);

// general statuses
defined("STATUS_ACTIVE")                    OR define("STATUS_ACTIVE"       , 1);
defined("STATUS_INACTIVE")                  OR define("STATUS_INACTIVE"     , 2);

// application statuses
defined("APP_STATUS_ACTIVE")                OR define("APP_STATUS_ACTIVE", 1);
defined("APP_STATUS_INACTIVE")              OR define("APP_STATUS_INACTIVE", 2);
defined("APP_STATUS_UNDER_REVIEW")          OR define("APP_STATUS_UNDER_REVIEW", 3);
defined("APP_STATUS_PENDING")               OR define("APP_STATUS_PENDING", 4);
defined("APP_STATUS_ARCHIVED")              OR define("APP_STATUS_ARCHIVED", 255);



defined("PSS_ACTIVE")                    OR define("PSS_ACTIVE"       , 1);
defined("PSS_INACTIVE")                    OR define("PSS_INACTIVE"       , 2);

defined("ES_ACTIVE")                    OR define("ES_ACTIVE"       , 1);
defined("ES_INACTIVE")                    OR define("ES_INACTIVE"       , 2);

defined("PROVIDER_SYSTEM_STATUS_ACTIVE")                    OR define("PROVIDER_SYSTEM_STATUS_ACTIVE"       , 1);
defined("PROVIDER_SYSTEM_STATUS_INACTIVE")                  OR define("PROVIDER_SYSTEM_STATUS_INACTIVE"     , 2);

defined("ROLE_ADMIN")                       OR define("ROLE_ADMIN"          , 1);
defined("ROLE_USER")                        OR define("ROLE_USER"           , 2);

defined("REPORT_PATH")                      OR define("REPORT_PATH"  ,$_ENV['REPORT_PATH'] ?? "");
defined("PROFILE_IMAGE_PATH")               OR define("PROFILE_IMAGE_PATH"  ,$_ENV['PROFILE_IMAGE_PATH'] ?? "");
defined("LOCATION_IMAGE_PATH")               OR define("LOCATION_IMAGE_PATH"  ,$_ENV['LOCATION_IMAGE_PATH'] ?? "");
defined("UPLOAD_PATH")                      OR define("UPLOAD_PATH", $_ENV['UPLOAD_PATH']);
defined("ASSETS_PATH")                      OR define("ASSETS_PATH", $_ENV['ASSETS_PATH']);
defined("GOOGLE_API_KEY")                   OR define("GOOGLE_API_KEY", $_ENV['GOOGLE_API_KEY']);

defined("REGISTERED_YEAR")                  OR define("REGISTERED_YEAR", $_ENV['REGISTERED_YEAR'] ?? date("Y"));

defined("NPI_API_URL")                      OR define("NPI_API_URL", $_ENV['NPI_API_URL'] ?? "");
defined("SEARCH_TYPE_EXACT")                OR define("SEARCH_TYPE_EXACT", 1);
defined("SEARCH_TYPE_FUZZY")                OR define("SEARCH_TYPE_FUZZY", 2);
defined("DF_EMPLOYMENT_STATUS")             OR define("DF_EMPLOYMENT_STATUS"       , 1); 
defined("DF_LEGACY_CDO")                    OR define("DF_LEGACY_CDO"       , 1);
defined("DF_PATIENT_PANEL")                 OR define("DF_PATIENT_PANEL"       , 2);
defined("DF_LOCATION_STATUS")               OR define("DF_LOCATION_STATUS"       , 1);
defined("DF_LOCATION_TYPE")                 OR define("DF_LOCATION_TYPE"       , 1);

defined("DF_RADIUS")                        OR define("DF_RADIUS", 5);
defined("DF_NUM_ROWS")                      OR define("DF_NUM_ROWS", 25);
defined("DF_PAGE")                          OR define("DF_PAGE", 1);
defined("DF_SORT_DIR")                      OR define("DF_SORT_DIR"                     , LIST_SORT_ASC);

// security hash encrypt
defined("SECRET_KEY")                       OR define("SECRET_KEY"                      , "#5%mXq\AMre/j)}Z2Jnv2%d6cH");
defined("SECRET_IV")                        OR define("SECRET_IV"                       , "HYN8Y=BfZJxQ8_=ZfXHt85aD*v");


defined("SKIP_EMAIL")                      OR define("SKIP_EMAIL", 1);

defined("SEND_EMAIL")                      OR define("SEND_EMAIL", 2);

// server config
defined("SHOW_LOG_DETAILS")                 OR define("SHOW_LOG_DETAILS",  FALSE);


// link application
defined("LINK_APPLICATION")                      OR define("LINK_APPLICATION", $_ENV['LINK_MANAGE_APPLICATION'] );


// files path
defined("TEMP_PATH")                        OR define("TEMP_PATH", ROOT_PATH . "/temp");

defined("LOG_PATH")                         OR define("LOG_PATH", ROOT_PATH . "/logs");
defined("TEMP_HASH_PATH")                         OR define("TEMP_HASH_PATH",$_ENV['TEMP_HASH_PATH']);

//entity type
defined("ENTITY_PROVIDER")                              OR define("ENTITY_PROVIDER", 1);
defined("ENTITY_LOCATION")                              OR define("ENTITY_LOCATION", 2);
defined("ENTITY_PROFILE")                               OR define("ENTITY_PROFILE", 3);
defined("ENTITY_PROVIDER_LOCATION")                     OR define("ENTITY_PROVIDER_LOCATION", 4);

defined("NO_REFERENCE")                                 OR define("NO_REFERENCE", 255);
defined("BUCKET_NAME")    OR define("BUCKET_NAME", $_ENV['BUCKET_NAME']);

// permissions levels self, team, organization
defined("PML_NONE")                 OR define("PML_NONE", 1);
defined("PML_SELF")                 OR define("PML_SELF", 2);
defined("PML_TEAM")                 OR define("PML_TEAM", 3);
defined("PML_ORG")                  OR define("PML_ORG", 9);