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

defined('MOODLE_INTERNAL') || die();

class report_laszloreport_generatereport {
    private $userid;
    private $sql;
    private $sqlparams = null;
    public $data = null;

    public function __construct($userid) {
        $this->setuserid($userid);
        $this->setsql();
        $this->setsqlparams();
        $this->grabdata();
    }

    /**
     * Collect all requested data.
     *
     * @global moodle_database $DB
     */
    public function grabdata() {
        global $DB;

        // Collect data from sql.
        $this->data = $DB->get_records_sql($this->sql, $this->sqlparams);

        if (!empty($this->data)) {
            // Formatting fields value.
            foreach ($this->data as $element) {
                unset($element->id);
                if (empty($element->timecompleted)) {
                    $element->completionstatus = get_string('notcomplete', 'report_laszloreport');
                } else {
                    $element->completionstatus = get_string('complete', 'report_laszloreport');
                    $element->timecompleted = userdate($element->timecompleted, get_string('strftimedatetime', 'langconfig'));
                }
            }
        }
    }

    private function setsql() {
        $this->sql = "SELECT ue.id,
                             c.id AS courseid,
                             c.fullname AS coursename,
                             CASE WHEN cc.timecompleted IS NULL THEN 'false' ELSE 'true' END AS completionstatus,
                             cc.timecompleted
                        FROM {user_enrolments} ue
                   LEFT JOIN {enrol} e
                          ON ue.enrolid = e.id
                   LEFT JOIN {course} c
                          ON e.courseid = c.id
                   LEFT JOIN {course_completions} cc
                          ON cc.userid = ue.userid AND cc.course = c.id
                       WHERE ue.userid = :userid
                    ORDER BY c.fullname";
    }

    private function setsqlparams() {
        $this->sqlparams = array(
            'userid' => $this->userid
        );
    }

    /**
     * @param int $userid
     */
    public function setuserid($userid) {
        $this->userid = $userid;
    }

}