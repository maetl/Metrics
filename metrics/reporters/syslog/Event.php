<?php
namespace metrics\reporters\syslog;

class Event
{
    protected $key;

    function __construct($key)
    {
        $this->key = $key;
    }

    function mark($options = array())
    {
		$facility = defined('LOG_LOCAL7') ? LOG_LOCAL7 : LOG_USER;
		if (!isset($options['identity'])) $options['identity'] = __NAMESPACE__;
		
		openlog($options['identity'], LOG_ODELAY, $facility);
		syslog(LOG_INFO, str_replace("\n", " ", $this->key));
		closelog();
    }
}