<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Defines the version and other meta-info about the plugin
 *
 * Setting the $plugin->version to 0 prevents the plugin from being installed.
 * See https://docs.moodle.org/dev/version.php for more info.
 *
 * @package    tool_deviceanalytics
 * @copyright  2016 Mark Heumueller <mark.heumueller@gmx.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__).'/../../../../config.php');
require_once('../locallib.php');
$systemcontext = context_system::instance();

require_login();
require_capability('tool/deviceanalytics:viewdashboard', $systemcontext);

$pagename = 'tool_deviceanalytics_dashboard';
$pagetitle = get_string('dashboard_title', 'tool_deviceanalytics');
$PAGE->set_context($systemcontext);
$PAGE->set_url('/admin/tool/deviceanalytics/admin/dashboard.php');
$PAGE->set_title($pagetitle);
$PAGE->set_heading($pagetitle);
$PAGE->set_pagelayout('admin');
$PAGE->set_cacheable(false);
$PAGE->requires->js('/admin/tool/deviceanalytics/libs/jquery-1.12.2.min.js', true);
$PAGE->requires->js('/admin/tool/deviceanalytics/libs/highcharts.js', true);

$analytics_data = tool_deviceanalytics_load_chart_datas();

//OUTPUT THE CHARS
echo $OUTPUT->header();

	echo $OUTPUT->heading(get_string('dashboard_name', 'tool_deviceanalytics'));
	echo '<pre>';
	echo var_dump($_SESSION);
	echo '</pre>';
	echo $OUTPUT->container_start(null, 'charts');
	
		$chart_names = tool_deviceanalytics_create_chart_containers();
		tool_deviceanalytics_create_chart_querys($analytics_data, $chart_names);
	echo $OUTPUT->container_end();
echo $OUTPUT->footer();