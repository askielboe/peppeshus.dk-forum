<?php if (!defined('IN_PHPBB')) exit; ?>Subject: Forum post notification - "<?php echo (isset($this->_rootref['FORUM_NAME'])) ? $this->_rootref['FORUM_NAME'] : ''; ?>"

Hello <?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?>,

You are receiving this notification because you are watching the forum, "<?php echo (isset($this->_rootref['FORUM_NAME'])) ? $this->_rootref['FORUM_NAME'] : ''; ?>" at "<?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?>". This forum has received a new reply to the topic "<?php echo (isset($this->_rootref['TOPIC_TITLE'])) ? $this->_rootref['TOPIC_TITLE'] : ''; ?>" since your last visit. You can use the following link to view the last unread reply, no more notifications will be sent until you visit the topic.

<?php echo (isset($this->_rootref['U_NEWEST_POST'])) ? $this->_rootref['U_NEWEST_POST'] : ''; ?>


If you want to view the topic, click the following link:
<?php echo (isset($this->_rootref['U_TOPIC'])) ? $this->_rootref['U_TOPIC'] : ''; ?>


If you want to view the forum, click the following link:
<?php echo (isset($this->_rootref['U_FORUM'])) ? $this->_rootref['U_FORUM'] : ''; ?>


If you no longer wish to watch this forum you can either click the "Unsubscribe forum" link found in the forum above, or by clicking the following link:

<?php echo (isset($this->_rootref['U_STOP_WATCHING_FORUM'])) ? $this->_rootref['U_STOP_WATCHING_FORUM'] : ''; ?>


<?php echo (isset($this->_rootref['EMAIL_SIG'])) ? $this->_rootref['EMAIL_SIG'] : ''; ?>