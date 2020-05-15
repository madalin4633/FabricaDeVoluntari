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

// how many to generate?
define("HOW_MANY_ASSOC", 12);
define("HOW_MANY_VOL", 12);

// ratings
define ("METRIC1","harnic");
define ("METRIC2","comunicativ");
define ("METRIC3","disponibil");
define ("METRIC4","punctual");
define ("METRIC5","serios");


require_once __DIR__ . "/generateFillTables/tblVolAssoc.php";
require_once __DIR__ . "/generateFillTables/tblAssociations.php";
require_once __DIR__ . "/generateFillTables/tblVolunteers.php";
require_once __DIR__ . "/generateFillTables/tblFeedback.php";
require_once __DIR__ . "/generateFillTables/viewVolunteerDashboard.php";

/**
 * called from api/createTables (admin only)
 */
function createTables($conn)
{
    dropViewVolunteerDashboard($conn);
    dropTableFeedback($conn);
    dropTableVolAssoc($conn);
    dropTableVolunteers($conn);
    dropTableAssociations($conn);

    createTableVolunteers($conn);
    createTableAssociations($conn);
    createTableVolAssoc($conn);
    createTableFeedback($conn);
    createViewVolunteerDashboard($conn);


}

function insertDataAll($conn) {
    insertDataAssociations($conn);
    insertDataVolunteers($conn);
    insertDataVolAssoc($conn);
    insertDataFeedback($conn);

}
