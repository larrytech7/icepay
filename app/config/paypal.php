<?php

return array(
    // set your paypal credential
    'client_id' => 'AegI_4RPjUmcS3_r59-XWfumfmmTUZ0aEsl7gqSxCH1ODLFcHvtgzH8AEUNT-734fLhN1ebOA8wjIZ2b',
    'secret' => 'EIBH4T5Oye4HRXmbvtstfwdRwBl4AnLKkXqxSe82eFjC4KoA4v0CMW4oVzjNfYc--DOVDzCs7lnfS2_I',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);