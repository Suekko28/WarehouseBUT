<?php

function warehouse($key = null)
{
    $data = [
        'finished' => [
            'label' => 'Gudang Finished',
            'vendor_name' => 'customer'
        ],
        'wip' => [
            'label' => 'Gudang WIP',
            'vendor_name' => 'customer'
        ],
        'child' => [
            'label' => 'Gudang Child Part & Komponent',
            'vendor_name' => 'supplier'
        ],
        'raw' => [
            'label' => 'Gudang Raw Material',
            'vendor_name' => 'supplier'
        ],
    ];

    $print = array_key_exists($key, $data) ? $data[$key] : $data;
    return $print ? $print : null;
}

function get_vendor_name($data) {
    return 'Nama '.ucwords($data);
}
