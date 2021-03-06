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

/**
 * Plugin version
 */
defined('MOODLE_INTERNAL') || die;

$plugin->component = 'report_laszloreport';
$plugin->version   = 2019010601; // If version == 0 then module will not be installed
$plugin->requires  = 2016120508; // Requires this Moodle version.
$plugin->maturity  = MATURITY_STABLE;
$plugin->release = '1.0 (Build 2019010600)';
$plugin->dependencies = array();
