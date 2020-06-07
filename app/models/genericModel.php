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
define("HOW_MANY_TASKS",5); // MAX TASKS
define("HOW_MANY_PROJECTS",3); // MAX TASKS

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
require_once __DIR__ . "/generateFillTables/viewVolunteerActivity.php";
require_once __DIR__ . "/generateFillTables/viewAssociationActivity.php";
require_once __DIR__ . "/generateFillTables/tblTasks.php";
require_once __DIR__ . "/generateFillTables/tblActivity.php";
require_once __DIR__ . "/generateFillTables/tblProjects.php";
require_once __DIR__ . "/generateFillTables/tblCertifications.php";

/**
 * called from api/createTables (admin only)
 */
function createTables($conn)
{
    dropViewVolunteerDashboard($conn);
    dropViewVolunteerActivity($conn);
    dropViewAssociationActivity($conn);
    dropViewActivityEnrolledVolunteers($conn);
    dropViewVolunteerNewTasks($conn);

   dropTableCertifications($conn);
    dropTableActivity($conn);
    dropTableFeedback($conn);
    dropTableTasks($conn);
    dropTableVolAssoc($conn);
    dropTableVolunteers($conn);
    dropTableProjects($conn);
    dropTableAssociations($conn);
 
    createTableVolunteers($conn);
    createTableAssociations($conn);
    createTableVolAssoc($conn);
     createTableProjects($conn);
   createTableTasks($conn);
    createTableFeedback($conn);
    createTableActivity($conn);
    createTableCertifications($conn);

    // createViewVolunteerDashboard($conn);
    // createViewVolunteerActivity($conn);
    // createViewAssociationActivity($conn);
    // createViewActivityEnrolledVolunteers($conn);
    // createViewVolunteerNewTasks($conn);

}

function createViews($conn)
{
    // dropViewVolunteerDashboard($conn);
    // dropViewVolunteerActivity($conn);
    // dropViewAssociationActivity($conn);
    dropViewActivityEnrolledVolunteers($conn);
    // dropViewVolunteerNewTasks($conn);
    // dropViewMyAssociationActivity($conn);

    // createViewVolunteerDashboard($conn);
    // createViewVolunteerActivity($conn);
    // createViewAssociationActivity($conn);
    createViewActivityEnrolledVolunteers($conn);
    // createViewVolunteerNewTasks($conn);
    // createViewMyAssociationActivity($conn);
}

function insertDataAll($conn) {
    // insertDataAssociations($conn);
    // insertDataVolunteers($conn);
    // insertDataVolAssoc($conn);
    // insertDataProjects($conn);
    // insertDataTasks($conn);

    // insertDataActivity($conn);
    // insertDataFeedback($conn);
}
