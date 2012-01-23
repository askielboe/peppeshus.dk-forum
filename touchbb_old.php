<?php
/*
* Code written by Chris Monahan, portions copyright phpBB.
*
* Please make sure that you do not upload this file to your
* site if you have received it from an untrusted source.
* This script is provided as-is without any warranty. By
* using this script you agree that MessageForums.net and
* its owners will not be held responsible for any issues
* that may arise from using this script. USE AT YOUR OWN RISK.
*/

// phpBB3 initialization
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// turn off all error reporting
error_reporting(0);

// start session management
$user->session_begin();
$auth->acl($user->data);

// make sure these variables are clean
$output = '';

// setup variables
$connectorVersion = '1.0';
$appVersion = '1.0';
$appName = 'TouchBB';
$appURL = "http://phobos.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=317752610&mt=8";
$fmfURL = "http://www.messageforums.net/touchbb.php";
$UA = $_SERVER['HTTP_USER_AGENT'];

// temporary!!!!!!!!!!!!!
$UA = str_replace('TouchBBLite', 'TouchBB', $UA);

$delims = array("|", "`", "~");
$get = request_var('get', '');
$id = request_var('id', 0);

// change this depending on what version is being used
$username = request_var('user', '');
$password = request_var('pass', '');
$search = request_var('search', '');

$strings = array("Last post by %s, %s",
                 "%d post%s in %d topic%s",
                 "No activity",
                 "By %s, %s",
                 "No replies",
                 "%d repl%s from %d view%s",
                 "%d unread message%s",
                 "%d read message%s",
                 "%s", // From %s
                 "%d sent message%s",
                 "%s", // To %s
);

// shorten the date format a little
$config['default_dateformat'] = str_replace('F', 'M', $config['default_dateformat']);
if ($user->date_format) {
  $user->date_format = str_replace('F', 'M', $user->date_format);
} else {
  $user->date_format = $config['default_dateformat'];
}

// figure out what version of the software they are using
if (substr_count($UA, $appName)) {
  if (@preg_match("/$appName\/(.*?)\s/", $UA, $match)) {
    $appVersion = $match[1];
  } elseif (@preg_match("/$appName(.*?)\s/", $UA, $match)) {
    $appVersion = $match[1];
  }
} else {
  displayStatus();
}

// ***************************
// ********** LOGIN **********
// ***************************
if ($username && $password) {
  $autologin = true;
  $viewonline = 1;
  $admin = 0;

  // v1.1 added base64 encoding to passwords. Simple encoding is used and not encryption.
  // The problem with a publically available wrapper is that the key used for encryption
  // would be available to anyone who downloaded this script thus not secure. The moral of
  // the story is not to use the same passwords used for bank accounts and secure data as
  // on forums. If this statement really bothers you, consider this. Almost all forums are
  // operated on http:// (non secure) URLs, and your password is sent out via plain text
  // anyway. If anyone has a solution to this that would work on multiple server configs
  // out there, please let me know.
  if (@version_compare($appVersion, '1.1', '>=')) {
    $password = base64_decode($password);
  }

  $result = $auth->login($username, $password, $autologin, $viewonline, $admin);
  if ($result['status'] == LOGIN_SUCCESS) {
    // do something later maybe?
  }
}

// ****************************
// ********** LOGOUT **********
// ****************************
if ($get == 'logout') {
  $user->session_kill();
  $user->session_begin();

  if ($user->data['is_registered']) {
    $output = 0;
  } else {
    $output = 1;
  }
}

// ****************************
// ********* ACTIVE ***********
// ****************************
if ($get == 'active') {
  include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

  // Configure style, language, etc.
  $user->setup('viewforum', $user->data['user_style']);

  // figure out what kind of reply counter to use
  $replyStr = ($auth->acl_get('m_approve', $id)) ? 'topic_replies_real' : 'topic_replies';

  // topic approved
  $sql_approved = ($auth->acl_get('m_approve', $id)) ? '' : ' AND t.topic_approved = 1';

  $sort_days = 7;
  $sql = "SELECT t.topic_id,t.topic_title,t.topic_last_post_time,t.topic_last_poster_name,username,topic_time,topic_views,$replyStr FROM " . TOPICS_TABLE . " t LEFT JOIN " . USERS_TABLE . " ON user_id=topic_poster WHERE t.topic_moved_id = 0 AND t.topic_last_post_time > " . (time() - ($sort_days * 24 * 3600)) . $sql_approved . " AND t.forum_id <> 16 ORDER BY t.topic_last_post_time DESC";

  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) {
    $row['type'] = 'Active Topics';
    $data[] = $row;
  }
  $db->sql_freeresult($result);

  for ($i=0;$i<count($data);$i++) {
    $row = $data[$i];

    if ($output) {
      $output .= $delims[0];
    }

    // tell the application that this is a topic
    $output .= clean(1) . $delims[1];

    $output .= clean($row['topic_id']) . $delims[1];

    if ($oldCategory != $row['type']) {
      $output .= clean($row['type']) . $delims[1];
    } else {
      $output .= $delims[1];
    }

    $output .= clean($row['topic_title']) . $delims[1];

    if ($row[$replyStr] > 0) {
      $output .= clean(sprintf($strings[0], $row['topic_last_poster_name'], $user->format_date($row['topic_last_post_time']))) . $delims[1];
    } else {
      $output .= clean(sprintf($strings[3], $row['username'], $user->format_date($row['topic_time']))) . $delims[1];
    }

    if ($row['topic_views'] > 0 && $row[$replyStr] > 0) {
      $output .= clean(sprintf($strings[5], $row[$replyStr], ($row[$replyStr]!=1)?'ies':'y', $row['topic_views'], ($row['topic_views']!=1)?'s':''));
    } else {
      $output .= clean($strings[4]);
    }

    $output .= $delims[1];

    $output .= clean($row['forum_id']);

    // save old topic id so we don't waste bandwidth repeating it
    $oldCategory = $row['type'];
  }
}

// ****************************
// ******* UNANSWERED *********
// ****************************
if ($get == 'unanswered') {
  include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

  // Configure style, language, etc.
  $user->setup('viewforum', $user->data['user_style']);

  // figure out what kind of reply counter to use
  $replyStr = ($auth->acl_get('m_approve', $id)) ? 'topic_replies_real' : 'topic_replies';

  // topic approved
  $sql_approved = ($auth->acl_get('m_approve', $id)) ? '' : ' AND p.post_approved = 1';

  $sql = "SELECT t.topic_id,t.topic_title,t.topic_last_post_time,t.topic_last_poster_name,username,topic_time,topic_views,$replyStr FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t LEFT JOIN " . USERS_TABLE . " ON user_id=topic_poster WHERE t.topic_replies = 0 AND t.topic_moved_id = 0 AND p.topic_id = t.topic_id" . $sql_approved . " AND p.forum_id <> 16 ORDER BY t.topic_last_post_time DESC";

  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) {
    $row['type'] = 'Unanswered Posts';
    $data[] = $row;
  }
  $db->sql_freeresult($result);

  for ($i=0;$i<count($data);$i++) {
    $row = $data[$i];

    if ($output) {
      $output .= $delims[0];
    }

    // tell the application that this is a topic
    $output .= clean(1) . $delims[1];

    $output .= clean($row['topic_id']) . $delims[1];

    if ($oldCategory != $row['type']) {
      $output .= clean($row['type']) . $delims[1];
    } else {
      $output .= $delims[1];
    }

    $output .= clean($row['topic_title']) . $delims[1];

    if ($row[$replyStr] > 0) {
      $output .= clean(sprintf($strings[0], $row['topic_last_poster_name'], $user->format_date($row['topic_last_post_time']))) . $delims[1];
    } else {
      $output .= clean(sprintf($strings[3], $row['username'], $user->format_date($row['topic_time']))) . $delims[1];
    }

    if ($row['topic_views'] > 0 && $row[$replyStr] > 0) {
      $output .= clean(sprintf($strings[5], $row[$replyStr], ($row[$replyStr]!=1)?'ies':'y', $row['topic_views'], ($row['topic_views']!=1)?'s':''));
    } else {
      $output .= clean($strings[4]);
    }

    $output .= $delims[1];

    $output .= clean($row['forum_id']);

    // save old topic id so we don't waste bandwidth repeating it
    $oldCategory = $row['type'];
  }
}

// ****************************
// *********** SENT ***********
// ****************************
if ($get == 'sent') {
  include($phpbb_root_path . 'includes/ucp/ucp_pm_viewfolder.' . $phpEx);

  // Configure style, language, etc.
  $user->setup('viewforum', $forum_data['forum_style']);

  // get the users private messages
  $pms = get_pm_from(PRIVMSGS_SENTBOX, '', $user->data['user_id']);

  // we only want the messages, not the index
  $pms = $pms['rowset'];

  // sort messages so newest is on top
  krsort($pms);

  $sentHeader = false;

  // separate messages into read and unread
  while (list($key, $msg) = each($pms)) {
    if ($output) {
      $output .= $delims[0];
    }

    // format output
    $output .= clean($msg['msg_id']) . $delims[1];
    $output .= ((!$i)?clean(sprintf($strings[9], count($pms), ((count($pms)==1)?'':'s'))):'') . $delims[1];
    $output .= clean($msg['message_subject']) . $delims[1];
    $output .= clean(sprintf($strings[10], $msg['username'])) . $delims[1];
    $output .= clean($user->format_date($msg['message_time']));

    $sentHeader = true;
  }
}

// ****************************
// ********** INBOX ***********
// ****************************
if ($get == 'inbox') {
  include($phpbb_root_path . 'includes/ucp/ucp_pm_viewfolder.' . $phpEx);

  // Configure style, language, etc.
  $user->setup('viewforum', $forum_data['forum_style']);

  // get the users private messages
  #$pms = get_pm_from(PRIVMSGS_INBOX, '', $user->data['user_id']);
  $pms = get_pm_from(0, '', $user->data['user_id']);
  #echo '<pre>'; print_r($pms); echo '</pre>';

  // we only want the messages, not the index
  $pms = $pms['rowset'];

  // sort messages so newest is on top
  krsort($pms);

  // separate messages into read and unread
  while (list($key, $val) = each($pms)) {
    if ($val['pm_unread']) {
      $unread[] = $val;
    } else {
      $read[] = $val;
    }
  }

  // send unread messages
  for ($i=0;$i<count($unread);$i++) {
    if ($output) {
      $output .= $delims[0];
    }

    // grab the current message
    $msg = $unread[$i];

    // format output
    $output .= clean($msg['msg_id']) . $delims[1];
    $output .= ((!$i)?clean(sprintf($strings[6], count($unread), ((count($unread)==1)?'':'s'))):'') . $delims[1];
    $output .= clean($msg['message_subject']) . $delims[1];
    $output .= clean(sprintf($strings[8], $msg['username'])) . $delims[1];
    $output .= clean($user->format_date($msg['message_time']));
  }

  // send read messages
  for ($i=0;$i<count($read);$i++) {
    if ($output) {
      $output .= $delims[0];
    }

    // grab the current message
    $msg = $read[$i];

    // format output
    $output .= clean($msg['msg_id']) . $delims[1];
    $output .= ((!$i)?clean(sprintf($strings[7], count($read), ((count($read)==1)?'':'s'))):'') . $delims[1];
    $output .= clean($msg['message_subject']) . $delims[1];
    $output .= clean(sprintf($strings[8], $msg['username'])) . $delims[1];
    $output .= clean($user->format_date($msg['message_time']));
  }
}

// ****************************
// *********** POST ***********
// ****************************
if ($get == 'post') {
  // don't allow anonymous posting so spam bots won't go crazy
  if ($user->data['is_registered']) {
//if ($user->data['user_id'] != ANONYMOUS && $topic_data['forum_status'] != ITEM_LOCKED && $topic_data['topic_status'] != ITEM_LOCKED) 
    include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
    include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
    include($phpbb_root_path . 'includes/message_parser.' . $phpEx);

    $message_parser = new parse_message();

    $message = request_var('txt', '');
    $message_parser->message = &$message;

    $title = request_var('title', '');
    $username = $user->data['username'];
    $update_message = true;
    $mode = 'post';
    $forum_id = request_var('fid', '');
    $post_data['poster_id'] = $user->data['user_id'];
    #$post_data['topic_approved'] = 1;
    #$post_data['post_approved'] = 1;
    #$post_data['topic_first_post_id'] = 2864;
    #$post_data['topic_last_post_id'] = 2959;
    $post_data['enable_bbcode'] = true;
    $post_data['enable_smilies'] = true;
    $post_data['enable_urls'] = true;

    // Parse message
    if ($update_message) {
      if (sizeof($message_parser->warn_msg)) {
        $error[] = implode('<br />', $message_parser->warn_msg);
        $message_parser->warn_msg = array();
      }

      $message_parser->parse($post_data['enable_bbcode'], ($config['allow_post_links']) ? $post_data['enable_urls'] : false, $post_data['enable_smilies'], $img_status, $flash_status, $quote_status, $config['allow_post_links']);

      // On a refresh we do not care about message parsing errors
      if (sizeof($message_parser->warn_msg) && $refresh) {
        $message_parser->warn_msg = array();
      }
    } else {
      $message_parser->bbcode_bitfield = $post_data['bbcode_bitfield'];
    }

    // Grab md5 'checksum' of new message
    $message_md5 = md5($message_parser->message);

    $data = array(
      'topic_title'         => $title,
      'topic_first_post_id' => (isset($post_data['topic_first_post_id'])) ? (int) $post_data['topic_first_post_id'] : 0,
      'topic_last_post_id'  => (isset($post_data['topic_last_post_id'])) ? (int) $post_data['topic_last_post_id'] : 0,
      'topic_time_limit'    => (int) $post_data['topic_time_limit'],
      'topic_attachment'    => (isset($post_data['topic_attachment'])) ? (int) $post_data['topic_attachment'] : 0,
      'post_id'             => (int) $post_id,
      'topic_id'            => (int) $topic_id,
      'forum_id'            => (int) $forum_id,
      'icon_id'             => (int) $post_data['icon_id'],
      'poster_id'           => (int) $post_data['poster_id'],
      'enable_sig'          => (bool) $post_data['enable_sig'],
      'enable_bbcode'       => (bool) $post_data['enable_bbcode'],
      'enable_smilies'      => (bool) $post_data['enable_smilies'],
      'enable_urls'         => (bool) $post_data['enable_urls'],
      'enable_indexing'     => (bool) $post_data['enable_indexing'],
      'message_md5'         => (string) $message_md5,
      'post_time'           => (isset($post_data['post_time'])) ? (int) $post_data['post_time'] : $current_time,
      'post_checksum'       => (isset($post_data['post_checksum'])) ? (string) $post_data['post_checksum'] : '',
      'post_edit_reason'    => $post_data['post_edit_reason'],
      'post_edit_user'      => ($mode == 'edit') ? $user->data['user_id'] : ((isset($post_data['post_edit_user'])) ? (int) $post_data['post_edit_user'] : 0),
      'forum_parents'       => $post_data['forum_parents'],
      'forum_name'          => $post_data['forum_name'],
      'notify'              => $notify,
      'notify_set'          => $post_data['notify_set'],
      'poster_ip'           => (isset($post_data['poster_ip'])) ? $post_data['poster_ip'] : $user->ip,
      'post_edit_locked'    => (int) $post_data['post_edit_locked'],
      'bbcode_bitfield'     => $message_parser->bbcode_bitfield,
      'bbcode_uid'          => $message_parser->bbcode_uid,
      'message'             => $message_parser->message,
      'attachment_data'     => $message_parser->attachment_data,
      'filename_data'       => $message_parser->filename_data,
      'topic_approved'      => (isset($post_data['topic_approved'])) ? $post_data['topic_approved'] : false,
      'post_approved'       => (isset($post_data['post_approved'])) ? $post_data['post_approved'] : false,
    );

    $output = clean(submit_post($mode, $title, $username, POST_NORMAL, $poll, $data, $update_message, 0));
  }
}

// ****************************
// *********** REPLY **********
// ****************************
if ($get == 'reply') {
  // don't allow anonymous posting so spam bots won't go crazy
  if ($user->data['is_registered']) {
//if ($user->data['user_id'] != ANONYMOUS && $topic_data['forum_status'] != ITEM_LOCKED && $topic_data['topic_status'] != ITEM_LOCKED) 
    include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
    include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
    include($phpbb_root_path . 'includes/message_parser.' . $phpEx);

    $message_parser = new parse_message();

    $message = request_var('txt', '');
    $message_parser->message = &$message;

    $title = request_var('title', '');
    $username = $user->data['username'];
    $update_message = true;
    $mode = 'reply';
    $forum_id = request_var('fid', '');
    $topic_id = request_var('tid', '');
    $post_data['poster_id'] = $user->data['user_id'];
    #$post_data['topic_approved'] = 1;
    #$post_data['post_approved'] = 1;
    #$post_data['topic_first_post_id'] = 2864;
    #$post_data['topic_last_post_id'] = 2959;
    $post_data['enable_bbcode'] = true;
    $post_data['enable_smilies'] = true;
    $post_data['enable_urls'] = true;

    // Parse message
    if ($update_message) {
      if (sizeof($message_parser->warn_msg)) {
        $error[] = implode('<br />', $message_parser->warn_msg);
        $message_parser->warn_msg = array();
      }

      $message_parser->parse($post_data['enable_bbcode'], ($config['allow_post_links']) ? $post_data['enable_urls'] : false, $post_data['enable_smilies'], $img_status, $flash_status, $quote_status, $config['allow_post_links']);

      // On a refresh we do not care about message parsing errors
      if (sizeof($message_parser->warn_msg) && $refresh) {
        $message_parser->warn_msg = array();
      }
    } else {
      $message_parser->bbcode_bitfield = $post_data['bbcode_bitfield'];
    }

    // Grab md5 'checksum' of new message
    $message_md5 = md5($message_parser->message);

    $data = array(
      'topic_title'         => $title,
      'topic_first_post_id' => (isset($post_data['topic_first_post_id'])) ? (int) $post_data['topic_first_post_id'] : 0,
      'topic_last_post_id'  => (isset($post_data['topic_last_post_id'])) ? (int) $post_data['topic_last_post_id'] : 0,
      'topic_time_limit'    => (int) $post_data['topic_time_limit'],
      'topic_attachment'    => (isset($post_data['topic_attachment'])) ? (int) $post_data['topic_attachment'] : 0,
      'post_id'             => (int) $post_id,
      'topic_id'            => (int) $topic_id,
      'forum_id'            => (int) $forum_id,
      'icon_id'             => (int) $post_data['icon_id'],
      'poster_id'           => (int) $post_data['poster_id'],
      'enable_sig'          => (bool) $post_data['enable_sig'],
      'enable_bbcode'       => (bool) $post_data['enable_bbcode'],
      'enable_smilies'      => (bool) $post_data['enable_smilies'],
      'enable_urls'         => (bool) $post_data['enable_urls'],
      'enable_indexing'     => (bool) $post_data['enable_indexing'],
      'message_md5'         => (string) $message_md5,
      'post_time'           => (isset($post_data['post_time'])) ? (int) $post_data['post_time'] : $current_time,
      'post_checksum'       => (isset($post_data['post_checksum'])) ? (string) $post_data['post_checksum'] : '',
      'post_edit_reason'    => $post_data['post_edit_reason'],
      'post_edit_user'      => ($mode == 'edit') ? $user->data['user_id'] : ((isset($post_data['post_edit_user'])) ? (int) $post_data['post_edit_user'] : 0),
      'forum_parents'       => $post_data['forum_parents'],
      'forum_name'          => $post_data['forum_name'],
      'notify'              => $notify,
      'notify_set'          => $post_data['notify_set'],
      'poster_ip'           => (isset($post_data['poster_ip'])) ? $post_data['poster_ip'] : $user->ip,
      'post_edit_locked'    => (int) $post_data['post_edit_locked'],
      'bbcode_bitfield'     => $message_parser->bbcode_bitfield,
      'bbcode_uid'          => $message_parser->bbcode_uid,
      'message'             => $message_parser->message,
      'attachment_data'     => $message_parser->attachment_data,
      'filename_data'       => $message_parser->filename_data,
      'topic_approved'      => (isset($post_data['topic_approved'])) ? $post_data['topic_approved'] : false,
      'post_approved'       => (isset($post_data['post_approved'])) ? $post_data['post_approved'] : false,
    );

    $output = clean(submit_post($mode, $title, $username, POST_NORMAL, $poll, $data, $update_message, 0));
  }
}

// ***************************
// ********* SEARCH **********
// ***************************
if ($search) {
  include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

  // Configure style, language, etc.
  $user->setup('viewforum', $user->data['user_style']);

  // figure out what kind of reply counter to use
  $replyStr = ($auth->acl_get('m_approve', $id)) ? 'topic_replies_real' : 'topic_replies';

  // topic approved
  $sql_approved = ($auth->acl_get('m_approve', $id)) ? '' : ' AND ' . TOPICS_TABLE . '.topic_approved = 1';

  $sqls['SELECT'] = 'topic_id,topic_title,topic_last_post_time,topic_last_poster_name,username,topic_time,topic_views,' . $replyStr . ',forum_id';

  $sql = "SELECT " . $sqls['SELECT'] . " FROM (" . TOPICS_TABLE . ") LEFT JOIN " . USERS_TABLE . " ON user_id=topic_poster WHERE topic_title LIKE '%" . $db->sql_escape($search) . "%' AND topic_type IN (" . POST_NORMAL . ")$sql_approved ORDER BY topic_type DESC,topic_last_post_time DESC";
  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) {
    $row['type'] = 'Matching Topics';
    $data[] = $row;
  }
  $db->sql_freeresult($result);

  // don't display data if there are more than a certain amount of results
  if (count($data) > 50) {
    unset($data);
  }

  for ($i=0;$i<count($data);$i++) {
    $row = $data[$i];

    if ($output) {
      $output .= $delims[0];
    }

    // tell the application that this is a topic
    $output .= clean(1) . $delims[1];

    $output .= clean($row['topic_id']) . $delims[1];

    if ($oldCategory != $row['type']) {
      $output .= clean($row['type']) . $delims[1];
    } else {
      $output .= $delims[1];
    }

    $output .= clean($row['topic_title']) . $delims[1];

    if ($row[$replyStr] > 0) {
      $output .= clean(sprintf($strings[0], $row['topic_last_poster_name'], $user->format_date($row['topic_last_post_time']))) . $delims[1];
    } else {
      $output .= clean(sprintf($strings[3], $row['username'], $user->format_date($row['topic_time']))) . $delims[1];
    }

    if ($row['topic_views'] > 0 && $row[$replyStr] > 0) {
      $output .= clean(sprintf($strings[5], $row[$replyStr], ($row[$replyStr]!=1)?'ies':'y', $row['topic_views'], ($row['topic_views']!=1)?'s':''));
    } else {
      $output .= clean($strings[4]);
    }

    $output .= $delims[1];

    $output .= clean($row['forum_id']);

    // save old topic id so we don't waste bandwidth repeating it
    $oldCategory = $row['type'];
  }
}

// ***************************
// ********** TOPIC **********
// ***************************
if ($get == 'topic') {
  // Configure style, language, etc.
  $user->setup('viewtopic');

  // query for output
  $sql = "SELECT post_id,poster_id,username,post_time,post_text,bbcode_uid,bbcode_bitfield FROM " . POSTS_TABLE . "," . USERS_TABLE . " WHERE " . USERS_TABLE . ".user_id=" . POSTS_TABLE . ".poster_id AND topic_id=" . $db->sql_escape($id) . " ORDER BY post_time";
  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) {
    if ($output) {
      $output .= $delims[0];
    }

    $output .= clean($row['post_id']) . $delims[1];
    $output .= clean($row['username']) . $delims[1];
    $output .= clean($row['post_text'], $row['bbcode_uid'], $row['bbcode_bitfield']) . $delims[1];
    $output .= clean('username') . $delims[1];
    $output .= clean($user->format_date($row['post_time']));
  }

  $db->sql_freeresult($result);
}

// ***************************
// ********** FORUM **********
// ***************************
if ($get == 'forum') {
  include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

  $sql_from = FORUMS_TABLE . ' f';
  $lastread_select = '';

  // Grab appropriate forum data
  if ($config['load_db_lastread'] && $user->data['is_registered']) {
    $sql_from .= ' LEFT JOIN ' . FORUMS_TRACK_TABLE . ' ft ON (ft.user_id = ' . $user->data['user_id'] . ' AND ft.forum_id = f.forum_id)';
    $lastread_select .= ', ft.mark_time';
  }

  if ($user->data['is_registered']) {
    $sql_from .= ' LEFT JOIN ' . FORUMS_WATCH_TABLE . ' fw ON (fw.forum_id = f.forum_id AND fw.user_id = ' . $user->data['user_id'] . ')';
    $lastread_select .= ', fw.notify_status';
  }

  $sql = "SELECT f.* $lastread_select FROM $sql_from WHERE f.forum_id = " . $db->sql_escape($id);
  $result = $db->sql_query($sql);
  $forum_data = $db->sql_fetchrow($result);
  $db->sql_freeresult($result);

  // Configure style, language, etc.
  $user->setup('viewforum', $forum_data['forum_style']);

  // Do we have subforums?
  $active_forum_ary = $moderators = array();

  if ($forum_data['left_id'] != $forum_data['right_id'] - 1) {
    list($active_forum_ary, $moderators) = display_forums($forum_data, $config['load_moderators'], $config['load_moderators']);
    $forums = $template->_tpldata['forumrow'];

    for ($i=0;$i<count($forums);$i++) {
      $forum = $forums[$i];

      if ($output) {
        $output .= $delims[0];
      }

      // tell the application that this is a forum
      $output .= clean(0) . $delims[1];

      $output .= clean($forum['FORUM_ID']) . $delims[1];

      if (!$i) {
        $output .= clean('Subforums') . $delims[1];
      } else {
        $output .= $delims[1];
      }

      $output .= clean($forum['FORUM_NAME']) . $delims[1];
      $output .= clean(sprintf($strings[0], $forum['LAST_POSTER'], $forum['LAST_POST_TIME'])) . $delims[1];

      if ($forum['POSTS'] > 0 && $forum['TOPICS'] > 0) {
        $output .= clean(sprintf($strings[1], $forum['POSTS'], ($forum['POSTS']!=1)?'s':'', $forum['TOPICS'], ($forum['TOPICS']!=1)?'s':''));
      } else {
        $output .= clean($strings[2]);
      }
    }
  }

  // figure out what kind of reply counter to use
  $replyStr = ($auth->acl_get('m_approve', $id)) ? 'topic_replies_real' : 'topic_replies';

  // topic approved
  $sql_approved = ($auth->acl_get('m_approve', $id)) ? '' : ' AND ' . TOPICS_TABLE . '.topic_approved = 1';

  $sqls['SELECT'] = 'topic_id,topic_title,topic_last_post_time,topic_last_poster_name,username,topic_time,topic_views,' . $replyStr;

  $sql = "SELECT " . $sqls['SELECT'] . " FROM (" . TOPICS_TABLE . ") LEFT JOIN " . USERS_TABLE . " ON user_id=topic_poster WHERE forum_id IN (" . $db->sql_escape($id) . ", 0) AND topic_type IN (" . POST_ANNOUNCE . ", " . POST_GLOBAL . ")$sql_approved ORDER BY topic_time DESC";
  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) {
    $row['type'] = 'Announcements';
    $data[] = $row;
  }
  $db->sql_freeresult($result);

  $sql = "SELECT " . $sqls['SELECT'] . " FROM (" . TOPICS_TABLE . ") LEFT JOIN " . USERS_TABLE . " ON user_id=topic_poster WHERE forum_id=" . $db->sql_escape($id) . " AND topic_type IN (" . POST_STICKY . ")$sql_approved ORDER BY topic_type DESC,topic_last_post_time DESC";
  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) {
    $row['type'] = 'Sticky';
    $data[] = $row;
  }
  $db->sql_freeresult($result);

  $sql = "SELECT " . $sqls['SELECT'] . " FROM (" . TOPICS_TABLE . ") LEFT JOIN " . USERS_TABLE . " ON user_id=topic_poster WHERE forum_id=" . $db->sql_escape($id) . " AND topic_type IN (" . POST_NORMAL . ")$sql_approved ORDER BY topic_type DESC,topic_last_post_time DESC LIMIT 20";
  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) {
    $row['type'] = 'Topics';
    $data[] = $row;
  }
  $db->sql_freeresult($result);

  for ($i=0;$i<count($data);$i++) {
    $row = $data[$i];

    if ($output) {
      $output .= $delims[0];
    }

    // tell the application that this is a topic
    $output .= clean(1) . $delims[1];

    $output .= clean($row['topic_id']) . $delims[1];

    if ($oldCategory != $row['type']) {
      $output .= clean($row['type']) . $delims[1];
    } else {
      $output .= $delims[1];
    }

    $output .= clean($row['topic_title']) . $delims[1];

    if ($row[$replyStr] > 0) {
      $output .= clean(sprintf($strings[0], $row['topic_last_poster_name'], $user->format_date($row['topic_last_post_time']))) . $delims[1];
    } else {
      $output .= clean(sprintf($strings[3], $row['username'], $user->format_date($row['topic_time']))) . $delims[1];
    }

    if ($row['topic_views'] > 0 && $row[$replyStr] > 0) {
      $output .= clean(sprintf($strings[5], $row[$replyStr], ($row[$replyStr]!=1)?'ies':'y', $row['topic_views'], ($row['topic_views']!=1)?'s':''));
    } else {
      $output .= clean($strings[4]);
    }

    // save old topic id so we don't waste bandwidth repeating it
    $oldCategory = $row['type'];
  }
}

// ***************************
// ******* FORUM INDEX *******
// ***************************
if ($get == 'index') {
  include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

  // Configure style, language, etc.
  $user->setup('viewforum');

  display_forums('', $config['load_moderators']);
  $forums = $template->_tpldata['forumrow'];

  for ($i=0;$i<count($forums);$i++) {
    $forum = $forums[$i];

    // Category with no members
    if ($forum['S_IS_CAT'] == 1) {
      $cat_name = $forum['FORUM_NAME'];
      continue;
    }

    if ($output) {
      $output .= $delims[0];
    }

    $output .= clean($forum['FORUM_ID']) . $delims[1];

    if ($oldCategory != $cat_name || $i == 0) {
      $output .= clean(($cat_name)?$cat_name:'Forum') . $delims[1];
    } else {
      $output .= $delims[1];
    }

    $output .= clean($forum['FORUM_NAME']) . $delims[1];

    if ($forum['POSTS'] > 0 && $forum['TOPICS'] > 0) {
      $output .= clean(sprintf($strings[0], $forum['LAST_POSTER'], $forum['LAST_POST_TIME'])) . $delims[1];
      $output .= clean(sprintf($strings[1], $forum['POSTS'], ($forum['POSTS']!=1)?'s':'', $forum['TOPICS'], ($forum['TOPICS']!=1)?'s':''));
    } else {
      $output .= clean($strings[2]) . $delims[1];
      $output .= '';
    }

    // save old topic id so we don't waste bandwidth repeating it
    $oldCategory = $cat_name;
  }
}

// ***************************
// ********* MEMBERS *********
// ***************************
if ($get == 'members') {
  $sql = "SELECT user_id,username FROM " . USERS_TABLE . " ORDER BY LOWER(username)";
  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) {
    if ($output) {
      $output .= $delims[0];
    }

    $output .= clean($row['user_id']) . $delims[1];
    $output .= clean($row['username']);
  }

  $db->sql_freeresult($result);
}

// ***************************
// ********* VALIDATE ********
// ***************************
if ($get == 'status') {
  $output .= 'OK' . $delims[1];
  $output .= clean($config['sitename']);
}

// has the script been run with parameters?
if ($get || $search) {
  // tell TouchBB info about this board and user
  $header = '';

  if (@version_compare($appVersion, '1.0', '<=')) {
    $header .= clean($config['sitename']) . $delims[1];
  }

  $header .= clean(($user->data['is_registered'])?1:0)  . $delims[1];

  // version 1.1 and higher supports private messaging
  if (@version_compare($appVersion, '1.1', '>=')) {
    $header .= clean($user->data['user_new_privmsg']);
  } else {
    $header .= clean(0);
  }

  // insert this into the output
  $output = $header . $delims[2] . $output;

  // make sure we are UTF8 compliant
  // $output = utf8_encode($output);

  // send the output to TouchBB
  echo $appName;

  if (@version_compare($appVersion, '1.0', '<=') || $get == 'status') {
    echo count($delims) . implode($delims, '');
  }

  echo $output . $delims[1] . md5($output);
} else {
  displayStatus();
}

// ***************************
// ******** FUNCTIONS ********
// ***************************
function clean($str, $uid = '', $bitfield = '') {
  global $fm, $config, $user, $phpbb_root_path, $delims;

  $str = stripslashes($str);
  $str = str_replace($delims, '', $str);
  $str = replace_all("\r\n", "\n", $str);

  if ($uid) {
    $str = str_replace("\n", '<br>', $str);

    // convert bbcode smilies to img sources, checking image width to see if it will fit on the phone or not
    if (preg_match_all('/<!-- s(.*?) --><img src="{SMILIES_PATH}\/(.*?)" alt="(.*?)" title="(.*?)" \/><!-- s(.*?) -->/is', $str, $matches)) {
      $tags = $matches[0];
      $icons = $matches[2];

      for ($i=0;$i<count($tags);$i++) {
        $resize = true;
        $local = $phpbb_root_path . $config['smilies_path'] . '/' . $icons[$i];
        if ($imagedata = @getimagesize($local)) {
          if ($imagedata[0] < 320) {
            $resize = false;
          }
        }

        $icon = '<img src="http://' . $config['server_name'] . $config['script_path'] . '/' . $config['smilies_path'] . '/' . $icons[$i] . '"' . (($resize)?' onload="resizeIMG(this);"':'') . '>';
        $str = str_replace($tags[$i], $icon, $str);
      }
    }

    // our list of bbcodes to change
    $bbcode = array('/\[i:' . $uid . '\](.*?)\[\/i:' . $uid . '\]/is' => '<i>$1</i>',
                    '/\[b:' . $uid . '\](.*?)\[\/b:' . $uid . '\]/is' => '<b>$1</b>',
                    '/\[u:' . $uid . '\](.*?)\[\/u:' . $uid . '\]/is' => '<u>$1</u>',
                    '/\[center:' . $uid . '\](.*?)\[\/center:' . $uid . '\]/is' => '<center>$1</center>',
                    '/\[hr:' . $uid . '\](.*?)\[\/hr:' . $uid . '\]/is' => '<hr>',
                    '/\[url:' . $uid . '\](.*?)\[\/url:' . $uid . '\]/is' => '<a href="$1">$1</a>',
                    '/\[url=(.*?):' . $uid . '\](.*?)\[\/url:' . $uid . '\]/is' => '<a href="$1">$2</a>',
                    '/<!-- m --><a class="postlink" href="(.*?)">(.*?)<\/a><!-- m -->/is' => '<a href="$1">$2</a>',
                    '/<!-- w --><a class="postlink" href="(.*?)">(.*?)<\/a><!-- w -->/is' => '<a href="$1">$2</a>',
                    '/\[quote=(.*?):' . $uid . '\](.*?)\[\/quote:' . $uid . '\]/is' => '<blockquote><cite>$1 wrote:</cite>$2</blockquote>',
                    '/\[quote:' . $uid . '\](.*?)\[\/quote:' . $uid . '\]/is' => '<blockquote>$1</blockquote>',
                    '/\[color=(.*?):' . $uid . '\](.*?)\[\/color:' . $uid . '\]/is' => '<font color="$1">$2</font>',
                    '/\[img:' . $uid . '\](.*?)\[\/img:' . $uid . '\]/is' => '<img src="$1" onload="resizeIMG(this);">',
                    '/\[size=(.*?):' . $uid . '\](.*?)\[\/size:' . $uid . '\]/is' => '<span style="font-size:$1%;line-height:normal">$2</span>',
                    '/\[code:' . $uid . '\](.*?)\[\/code:' . $uid . '\]/is' => '<dl class="codebox"><dt>Code:</dt><dd><code>$1</code></dd></dl>',
    );

    // make sure we fully change all bbcode. this does loop one extra time per change.
    // it's the easiest way to make sure all changes are completed
    $count = -1;
    while ($count != 0) {
      $str = preg_replace(array_keys($bbcode), array_values($bbcode), $str, -1, $count);
    }

    #do {
    #  $str = preg_replace(array_keys($bbcode), array_values($bbcode), $str, -1, $count);
    #} while ($count);
  } else {
    $str = replace_all("\n", ' ', $str);
    $str = replace_all('<br>', ' ', $str);
    $str = html_entity_decode($str);
  }

  $str = preg_replace('/\s\s+/', ' ', $str);
  $str = trim($str);

  return $str;
}

function replace_all($old, $new, $str) {
  do {
    $str = str_replace($old, $new, $str, $count);
  } while ($count);

  return $str;
}

function displayStatus() {
  global $appName, $connectorVersion, $appURL, $fmfURL, $config, $phpEx, $phpbb_root_path;

  // script is working variable
  $works = true;

  if (!@include($phpbb_root_path . 'includes/functions_posting.' . $phpEx)) { $works = false; }
  if (!@include($phpbb_root_path . 'includes/functions_display.' . $phpEx)) { $works = false; };
  if (!@include($phpbb_root_path . 'includes/message_parser.' . $phpEx)) { $works = false; };
  if (!@include($phpbb_root_path . 'includes/ucp/ucp_pm_viewfolder.' . $phpEx)) { $works = false; };

  // only continue if we didn't receive an error above
  if (!$works) {
    // list of functions to check for
    $functions[] = 'clean';
    $functions[] = 'submit_post';
    $functions[] = 'preg_replace';
    $functions[] = 'get_pm_from';
    $functions[] = 'display_forums';
    $functions[] = 'replace_all';
    $functions[] = 'array_keys';
    $functions[] = 'array_values';
    $functions[] = 'html_entity_decode';

    // loop through functions to check
    for ($i=0;$i<count($functions);$i++) {
      if (!function_exists($functions[$i])) {
        $works = false;
      }
    }
  }

  echo '<html><head><title>TouchBB Status</title></head><body>';
  echo "$appName v$connectorVersion script " . (($works)?"enabled for ${config['sitename']}!":'is not working.') . '<br>';

  if ($works) {
    echo "You may download <a href=\"$appURL\">$appName</a> from the App Store.";
  } else {
    echo "Please visit <a href=\"$fmfURL\">$fmfURL</a> for support.";
  }

  echo "</body></html>";

  exit;
}
