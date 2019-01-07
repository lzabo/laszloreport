<?php
// This file is part of Totara LMS.
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
// @package    report
// @subpackage laszloreport
// @copyright  Záborski László <zaborski.laszlo@gmail.com>
// @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir . '/adminlib.php');

defined('MOODLE_INTERNAL') || die();

require_login();

// One way to restrict accessibility.
if (!is_siteadmin()) {
    print_error('nopermissiontoviewpage');
}

// Another way to check permissions.
require_capability('report/laszloreport:view', context_system::instance());

admin_externalpage_setup('report_laszloreport');

$selecteduserid = optional_param('userid', false, PARAM_INT);

if (empty($selecteduserid)) {
    $userform = new report_laszloreport_userselectorform();

    // Page created by using simple ouput class.
    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('pluginname', 'report_laszloreport'));
    $userform->display();
    echo $OUTPUT->footer();
} else {

    $report = new report_laszloreport_generatereport($selecteduserid);

    // Page created by using renderer.
    $renderer = $PAGE->get_renderer('report_laszloreport');
    echo $renderer->render_report($report);
}