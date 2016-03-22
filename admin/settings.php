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

require_once('../lib.php');

$systemcontext = context_system::instance();
require_login();
require_capability('tool/deviceanalytics:managesettings', $systemcontext);

$pagename = 'tool_deviceanalytics_settings';
$PAGE->set_context($systemcontext);
$PAGE->set_url('/admin/tool/deviceanalytics/admin/settings.php');
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('settings_title', 'tool_deviceanalytics'));
$PAGE->set_heading(get_string('settings_title', 'tool_deviceanalytics'), 3);
admin_externalpage_setup($pagename);

$settings_form = new deviceanalytics_settings_form();

if ($settings_form->is_cancelled()) {
	echo $OUTPUT->header();
		echo $OUTPUT->container(get_string('settings_cancelled', 'tool_deviceanalytics'), 'important', 'notice');
		echo $OUTPUT->continue_button(new moodle_url('/admin/tool/deviceanalytics/admin/settings.php', array()));
	echo $OUTPUT->footer();
	
} else if ($fromform = $settings_form->get_data()) {
	$DB->update_record('tool_deviceanalytics', $fromform);
	echo $OUTPUT->header();
		echo $OUTPUT->container(get_string('settings_updated', 'tool_deviceanalytics'), 'important', 'notice');
		echo $OUTPUT->continue_button(new moodle_url('/admin/tool/deviceanalytics/admin/settings.php', array()));
	echo $OUTPUT->footer();
}else { 
	global $time_format;
	$db_data = $DB->get_record('tool_deviceanalytics', array(), '*');
	$settings_form->set_data($db_data);
	echo $OUTPUT->header();
		echo $OUTPUT->heading(get_string('settings_title', 'tool_deviceanalytics'));
		$settings_form->display();
	echo $OUTPUT->footer();
}