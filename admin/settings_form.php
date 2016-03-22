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

class deviceanalytics_settings_form extends moodleform{

	public function definition() {
        global $CFG;
        $mform = $this->_form;
        $start_attr=array('readonly'=>'readonly');
        $mform->addElement('text', 'starttime', get_string('settings_starttime', 'tool_deviceanalytics'), $start_attr);
        $mform->setType('starttime', PARAM_RAW);
        $mform->addElement('hidden', 'id', '1');
        $mform->setType('id', PARAM_RAW);
        $mform->addElement('selectyesno', 'status', get_string('settings_status', 'tool_deviceanalytics'));
        $mform->addElement('selectyesno', 'anonymous', get_string('settings_anonymous', 'tool_deviceanalytics'));
        $mform->addElement('selectyesno', 'admin_log', get_string('settings_admin_log', 'tool_deviceanalytics'));
        $this->add_action_buttons();
    }

}