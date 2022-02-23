<?php

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/clilib.php');
require_once($CFG->libdir . '/moodlelib.php');
require_once($CFG->libdir . '/installlib.php');
require_once($CFG->libdir . '/dmllib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once($CFG->dirroot . '/' . $CFG->admin . '/webservice/lib.php');
require_once($CFG->dirroot . '/webservice/lib.php');

cli_writeln('Configure curl settings');
set_config('curlsecurityblockedhosts', '169.254.169.254');
set_config('curlsecurityallowedport', "443\n80\n8080");

cli_writeln('Configure debugger settings');
set_config('debug', DEBUG_DEVELOPER);
set_config('perfdebug', 1);
set_config('debugpageinfo', 1);

cli_writeln('Configure settings for tool_opencast');
set_config('ocinstances', '[{"id": 1, "name":"Default",  "isvisible": 1, "isdefault": 1}]',
    'tool_opencast');
set_config('apiurl', 'http://opencast:8080', 'tool_opencast');
set_config('apiusername', 'moodle', 'tool_opencast');
set_config('apipassword', 'moodle', 'tool_opencast');
set_config('connecttimeout', 1, 'tool_opencast');

cli_writeln('Configure settings for block_opencast');
set_config('uploadworkflow_1', 'schedule-and-upload', 'block_opencast');
set_config('enable_opencast_studio_link_1', 1, 'block_opencast');
set_config('opencast_studio_baseurl_1', 'http://localhost:8080', 'block_opencast');
set_config('lticonsumerkey_1', 'CONSUMERKEY', 'block_opencast');
set_config('lticonsumersecret_1', 'CONSUMERSECRET', 'block_opencast');
set_config('engageurl_1', 'http://localhost:8080', 'block_opencast');
set_config('engagelticonsumerkey_1', 'CONSUMERKEY', 'block_opencast');
set_config('engagelticonsumersecret_1', 'CONSUMERSECRET', 'block_opencast');
set_config('download_channel_1', 'engage-player', 'block_opencast');
set_config('addactivityenabled_1', 1, 'block_opencast');
set_config('addactivityintro_1', 1, 'block_opencast');
set_config('addactivitysection_1', 1, 'block_opencast');
set_config('addactivityavailability_1', 1, 'block_opencast');
set_config('addactivityepisodeenabled_1', 1, 'block_opencast');

cli_writeln('Configure settings for mod_opencast');
set_config('channel_1', 'engage-player', 'mod_opencast');
set_config('download_channel_1', 'engage-player', 'mod_opencast');

cli_writeln('Configure settings for repository_opencast');
$repository = new stdClass();
$repository->edit = 0;
$repository->new = "opencast";
$repository->plugin = "opencast";
$repository->typeid = 0;
$repository->contextid = 1;
$repository->name = "Opencast videos";
$repository->opencast_instance = 1;
$repository->opencast_author = "";
$repository->opencast_channelid = "engage-player";
$repository->opencast_thumbnailflavor = "";
$repository->opencast_thumbnailflavorfallback = "";
$repository->opencast_playerurl = 1;
$repository->opencast_videoflavor = "";
$repository->submitbutton = "Save";
repository::create('opencast', 0, context_system::instance(), $repository);

# Settings for filter_opencast
cli_writeln('Configure settings for filter_opencast');
set_config('episodeurl_1', 'http://localhost:8080/play/[EPISODEID]', 'filter_opencast');

cli_writeln('Successfully initialized moodle.');

exit(0);
