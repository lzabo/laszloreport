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

class report_laszloreport_renderer extends plugin_renderer_base {

    /**
     * @param $report
     * @return string
     */
    public function render_report($report) {
        $output = '';

        $output .= $this->output->header();
        $output .= $this->output->heading(get_string('pluginname', 'report_laszloreport'));

        $output .= '<table>';
        $output .= $this->table_headers();

        if (empty($report->data)) {
            $output .= $this->table_empty();
        } else {
            $output .= $this->table_contents($report->data);
        }
        $output .= '</table>';
        return $output;
    }

    private function table_headers() {
        $output = '';
        $output .= '    <thead>';
        $output .= '        <th>' . get_string('course', 'report_laszloreport') . '</th>';
        $output .= '        <th>' . get_string('completion', 'report_laszloreport') . '</th>';
        $output .= '        <th>' . get_string('time', 'report_laszloreport') . '</th>';
        $output .= '    </thead>';

        $output .= $this->output->footer();

        return $output;
    }

    private function table_contents($data) {
        $output = '';
        $output .= '    <tbody>';

        foreach ($data as $element) {
            $url = new moodle_url('/course/view.php', array('id' => $element->courseid));

            $output .= '        <tr>';
            $output .= '            <td>' . html_writer::link($url, $element->coursename) . '</td>';
            $output .= '            <td>' . $element->completionstatus . '</td>';
            $output .= '            <td>' . $element->timecompleted . '</td>';
            $output .= '        </tr>';
        }
        $output .= '    </tbody>';

        return $output;
    }

    private function table_empty() {
        $output = '';
        $output .= '    <tbody>';
        $output .= '        <tr>';
        $output .= '            <td colspan="3">' . get_string('emptyreport', 'report_laszloreport') . '</td>';
        $output .= '        </tr>';
        $output .= '    </tbody>';

        return $output;
    }

}