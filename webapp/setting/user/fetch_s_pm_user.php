<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'tbl_users';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'username',  'dt' => 1 ),
    array( 'db' => 'email',   'dt' => 2 ),
    array( 'db' => 'level',   'dt' => 3 ),
    array( 'db' => 'system',   'dt' => 4 ),
    array( 'db' => 'emp_code',   'dt' => 5 ),
    array( 'db' => 'create_by',   'dt' => 6 ),
    array( 'db' => 'create_date_time',   'dt' => 7 ),
    array( 'db' => 'last_login',   'dt' => 8 ),
    array( 'db' => 'status',     'dt' => 9 ),
    array(
      'db' => 'id',
      'dt' => 10,
      'formatter' => function( $d, $row ) {
          return '<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editModal" data-whatever="'.$d.'" style="margin-bottom:2px;"><span class="glyphicon glyphicon-edit"></span></button>
                  <button class="btn btn-danger btn-xs delete" data-row-id="'.$d.'" style="margin-right:3px;"><span class="glyphicon glyphicon-trash"></span></button>';
        }
    )
);

// SQL server connection information
$sql_details = array(
    'user' => 'palmd',
    'pass' => 'palmd2013',
    'db'   => 'palmd',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( '../../../include/ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
