<?php

/**
 *
 * @author Serkan KOYUNCU
 *
 */

class skCustomValidatorUrl extends sfValidatorRegex
{
    const REGEX_URL_FORMAT = '~^
    ((%s)://)?
    (
    ([a-z0-9-]+\.)+[a-z]{2,6}
    |
    \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}
    )
    (:[0-9]+)?
    (/?|/\S+)
    $~ix';

    protected function configure($options = array(), $messages = array())
    {
        parent::configure($options, $messages);

        $this->addOption('protocols', array('http', 'https', 'ftp', 'ftps'));
        $this->setOption('pattern', new sfCallable(array($this, 'generateRegex')));
    }

    public function generateRegex()
    {
        return sprintf(self::REGEX_URL_FORMAT, implode('|', $this->getOption('protocols')));
    }
}
