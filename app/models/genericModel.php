<?php
/**
 * Model for api calls:
 * POST api/createTables/ => createTables()
 * POST api/createTables/Associations => createTableAssoc()
 * POST api/createTables/Volunteers => createTableVolunteers()
 * POST api/createTables/VolAssoc => createTableVolAssoc()
 *
 * 
 * DELETE api/createTables/Associations => dropTableAssoc()
 * DELETE api/createTables/Volunteers => dropTableVolunteers()
 * DELETE api/createTables/VolAssoc => dropTableVolAssoc()
 *
 * PUT api/createTables/Associations => insertDataAssociations()
 * PUT api/createTables/Volunteers => insertDataVolunteers()
 * PUT api/createTables/VolAssoc => insertDataVolAssoc()
 *
 */

define("HOW_MANY_ASSOC", 12);
define("HOW_MANY_VOL", 12);

require_once __DIR__ . "/generateFillTables/tblVolAssoc.php";
require_once __DIR__ . "/generateFillTables/tblAssociations.php";
require_once __DIR__ . "/generateFillTables/tblVolunteers.php";
require_once __DIR__ . "/generateFillTables/tblFeedback.php";

/**
 * called from api/createTables (admin only)
 */
function createTables($conn)
{
    dropTableFeedback($conn);
    dropTableVolAssoc($conn);
    dropTableVolunteers($conn);
    dropTableAssociations($conn);

    createTableVolunteers($conn);
    createTableAssociations($conn);
    createTableVolAssoc($conn);
    createTableFeedback($conn);
}


