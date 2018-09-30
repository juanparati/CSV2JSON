<?php
return array(
    'file'      =>
    [
        'description'   => 'CSV file',
        'optional'      => false,
        'accept_value'  => 'path',
    ],
    'output'      =>
    [
        'long_arg'      => 'output',
        'description'   => 'Json file',
        'optional'      => true,
        'accept_value'  => 'path',
        'value'         => false,
    ],
    'delimiter' =>
    [
        'long_arg'      => 'delimiter',
        'description'   => 'CSV delimiter',
        'optional'      => true,
        'value'         => 'comma',
    ],
    'text-enclosure' =>
    [
        'long_arg'      => 'text-enclosure',
        'description'   => 'CSV text enclosure',
        'optional'      => true,
        'value'         => 'quotes',
    ],
    'decimal-sep' =>
    [
        'long_arg'      => 'decimal-sep',
        'description'   => 'Decimal separator symbol',
        'optional'      => true,
        'value'         => 'point',
    ],
    'escape-char' =>
    [
        'long_arg'      => 'escape-char',
        'description'   => 'Escape character',
        'optional'      => true,
        'value'         => '\\'
    ],
    'charset' =>
    [
        'long_arg'      => 'charset',
        'description'   => 'File charset',
        'optional'      => true,
        'value'         => 'UTF-8'
    ],
    'stream-filter' =>
    [
        'long_arg'      => 'stream-filter',
        'description'   => 'Stream filter',
        'optional'      => true,
    ],
    'no-interactive' =>
    [
        'short_arg'     => 'n',
        'description'   => 'Disable interactive mode',
        'optional'      => true,
    ],
    'help'      =>
    [
        'long_arg'      => 'help',
        'short_arg'     => 'h',
        'description'   => 'Show help',
        'optional'      => true
    ],
);
