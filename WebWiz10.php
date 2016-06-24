<?php

/**
 * Example converter base impoprter template for bbPress
 *
 * @since bbPress (r4689)
 * @link Codex Docs http://codex.bbpress.org/import-forums/custom-import
 */
include 'functions.webwizhash.php';
 
class WebWiz10 extends BBP_Converter_Base {

	/**
	 * Main Constructor
	 *
	 * @uses Example_Converter::setup_globals()
	 */
	function __construct() {
		parent::__construct();
		$this->setup_globals();
	}

	/**
	 * Sets up the field mappings
	 */
	public function setup_globals() {

		/** Forum Section *****************************************************/

		// Setup table joins for the forum section at the base of this section

		// Forum id (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblForum',
			'from_fieldname'  => 'Forum_ID',
			'to_type'         => 'forum',
			'to_fieldname'    => '_bbp_forum_id'
		);

		// Forum parent id (If no parent, then 0. Stored in postmeta)
        /*
		$this->field_map[] = array(
			'from_tablename'  => 'tblCategory',
			'from_fieldname'  => 'Cat_ID',
			'join_tablename'  => 'tblForum',
			'join_type'       => 'INNER',
			'join_expression' => 'ON tblForum.Cat_ID = tblCategory.Cat_ID',
			'to_type'         => 'forum',
			'to_fieldname'    => '_bbp_forum_parent_id'
		);
        */

		// Forum topic count (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename' => 'tblForum',
			'from_fieldname' => 'No_of_topics',
			'to_type'        => 'forum',
			'to_fieldname'   => '_bbp_topic_count'
		);

		// Forum reply count (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename' => 'tblForum',
			'from_fieldname' => 'No_of_posts',
			'to_type'        => 'forum',
			'to_fieldname'   => '_bbp_reply_count'
		);

        /*
		// Forum total topic count (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename' => 'tblForum',
			'from_fieldname' => 'the_total_topic_count',
			'to_type'        => 'forum',
			'to_fieldname'   => '_bbp_total_topic_count'
		);

		// Forum total reply count (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename' => 'tblForum',
			'from_fieldname' => 'the_total_reply_count',
			'to_type'        => 'forum',
			'to_fieldname'   => '_bbp_total_reply_count'
		);
        */

		// Forum title.
		$this->field_map[] = array(
			'from_tablename'  => 'tblForum',
			'from_fieldname'  => 'Forum_name',
			'to_type'         => 'forum',
			'to_fieldname'    => 'post_title'
		);

        /*
		// Forum slug (Clean name to avoid confilcts)
		$this->field_map[] = array(
			'from_tablename'  => 'tblForum',
			'from_fieldname'  => 'Forum_ID',
			'to_type'         => 'forum',
			'to_fieldname'    => 'post_name',
			'callback_method' => 'callback_slug'
		);
        */

		// Forum description.
		$this->field_map[] = array(
			'from_tablename'  => 'tblForum',
			'from_fieldname'  => 'Forum_description',
			'to_type'         => 'forum',
			'to_fieldname'    => 'post_content',
			'callback_method' => 'callback_null'
		);

		// Forum display order (Starts from 1)
		$this->field_map[] = array(
			'from_tablename'  => 'tblForum',
			'from_fieldname'  => 'Forum_Order',
			'to_type'         => 'forum',
			'to_fieldname'    => 'menu_order'
		);

		// Forum dates.
		$this->field_map[] = array(
			'to_type'         => 'forum',
			'to_fieldname'    => 'post_date',
			'default' => date('Y-m-d H:i:s')
		);
		$this->field_map[] = array(
			'to_type'         => 'forum',
			'to_fieldname'    => 'post_date_gmt',
			'default' => date('Y-m-d H:i:s')
		);
		$this->field_map[] = array(
			'to_type'         => 'forum',
			'to_fieldname'    => 'post_modified',
			'default' => date('Y-m-d H:i:s')
		);
		$this->field_map[] = array(
			'to_type'         => 'forum',
			'to_fieldname'    => 'post_modified_gmt',
			'default' => date('Y-m-d H:i:s')
		);

		// Setup the table joins for the forum section
		$this->field_map[] = array(
			'from_tablename'  => 'tblCategory',
			'from_fieldname'  => 'Cat_ID',
			'join_tablename'  => 'tblForum',
			'join_type'       => 'INNER',
			'join_expression' => 'ON tblForum.Cat_ID = tblCategory.Cat_ID',
		//	'from_expression' => 'WHERE forums_table.forum_id != 1',
			'to_type'         => 'forum'
		);

		/** Topic Section *****************************************************/

		// Setup table joins for the topic section at the base of this section

		// Topic id (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Topic_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => '_bbp_topic_id'
		);

		// Topic reply count (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'No_of_replies',
			'to_type'         => 'topic',
			'to_fieldname'    => '_bbp_reply_count',
			//'callback_method' => 'callback_topic_reply_count'
		);

        /*
		// Topic total reply count (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'the_total_topic_reply_count',
			'to_type'         => 'topic',
			'to_fieldname'    => '_bbp_total_reply_count',
			'callback_method' => 'callback_topic_reply_count'
		);
        */

		// Topic parent forum id (If no parent, then 0. Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Forum_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => '_bbp_forum_id',
		    'callback_method' => 'callback_forumid'
		);

		// Topic author.
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Author_ID',
            'join_tablename'  => 'tblTopic',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Start_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_author',
			'callback_method' => 'callback_userid'
		);

		// Topic author ip (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'IP_addr',
            'join_tablename'  => 'tblTopic',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Start_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => '_bbp_author_ip'
		);

		// Topic content.
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message',
            'join_tablename'  => 'tblTopic',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Start_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_content',
			'callback_method' => 'callback_html'
		);

		// Topic title.
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Subject',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_title'
		);

        /*
		// Topic slug (Clean name to avoid conflicts)
		$this->field_map[] = array(
			'from_tablename'  => 'topics_table',
			'from_fieldname'  => 'the_topic_slug',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_name',
			'callback_method' => 'callback_slug'
		);
        */
        
        // Topic status (Open or Closed)
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Locked',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_status',
			'callback_method' => 'callback_topic_status'
		);

		// Topic parent forum id (If no parent, then 0)
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Forum_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_parent',
			'callback_method' => 'callback_forumid'
		);

		// Sticky status (Stored in postmeta))
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Priority',
			'to_type'         => 'topic',
			'to_fieldname'    => '_bbp_old_sticky_status',
			'callback_method' => 'callback_sticky_status'
		);

		// Topic dates.
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
            'join_tablename'  => 'tblTopic',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Start_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_date',
			'callback_method' => 'callback_datetime'
		);
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
            'join_tablename'  => 'tblTopic',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Start_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_date_gmt',
			'callback_method' => 'callback_datetime'
		);
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
            'join_tablename'  => 'tblTopic',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Last_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_modified',
			'callback_method' => 'callback_datetime'
		);
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
            'join_tablename'  => 'tblTopic',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Last_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => 'post_modified_gmt',
			'callback_method' => 'callback_datetime'
		);
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
            'join_tablename'  => 'tblTopic',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Last_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic',
			'to_fieldname'    => '_bbp_last_active_time',
			'callback_method' => 'callback_datetime'
		);

		// Setup any table joins needed for the topic section
        /*
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Topic_ID',
			'join_tablename'  => 'tblThread',
			'join_type'       => 'INNER',
			'join_expression' => 'ON tblTopic.Topic_ID = tblThread.Topic_ID',
			'from_expression' => 'WHERE tblTopic.Start_Thread_ID = tblThread.Thread_ID',
			'to_type'         => 'topic'
		);
        */
        
		/** Tags Section ******************************************************/

        /*
		// Setup table joins for the tag section at the base of this section
		// Setup any table joins needed for the tags section
		$this->field_map[] = array(
			'from_tablename'  => 'tag_table',
			'from_fieldname'  => 'the_topic_id',
			'join_tablename'  => 'tagcontent_table',
			'join_type'       => 'INNER',
			'join_expression' => 'USING tagcontent_table.tag_id = tags_table.tag_id',
			'from_expression' => 'WHERE tagcontent_table.tag_id = tag_table.tag_id',
			'to_type'         => 'tags'
		);

		// Topic id.
		$this->field_map[] = array(
			'from_tablename'  => 'tagcontent_table',
			'from_fieldname'  => 'contentid',
			'to_type'         => 'tags',
			'to_fieldname'    => 'objectid',
			'callback_method' => 'callback_topicid'
		);

		// Taxonomy ID.
		$this->field_map[] = array(
			'from_tablename'  => 'tagcontent_table',
			'from_fieldname'  => 'tagid',
			'to_type'         => 'tags',
			'to_fieldname'    => 'taxonomy'
		);

		// Term text.
		$this->field_map[] = array(
			'from_tablename'  => 'tag_table',
			'from_fieldname'  => 'tagtext',
			'to_type'         => 'tags',
			'to_fieldname'    => 'name'
		);

		// Term slug.
		$this->field_map[] = array(
			'from_tablename'  => 'tag_table',
			'from_fieldname'  => 'tagslug',
			'to_type'         => 'tags',
			'to_fieldname'    => 'slug',
			'callback_method' => 'callback_slug'
		);

		// Term description.
		$this->field_map[] = array(
			'from_tablename'  => 'tag_table',
			'from_fieldname'  => 'tagdescription',
			'to_type'         => 'tags',
			'to_fieldname'    => 'description'
		);
        */

		/** Reply Section *****************************************************/

		// Setup table joins for the reply section at the base of this section

		// Reply id (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Thread_ID',
			'to_type'         => 'reply',
			'to_fieldname'    => '_bbp_post_id'
		);

		// Reply parent forum id (If no parent, then 0. Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Forum_ID',
            'join_tablename'  => 'tblThread',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Topic_ID = tblThread.Topic_ID WHERE tblThread.Thread_ID != tblTopic.Start_Thread_ID',
			'to_type'         => 'reply',
			'to_fieldname'    => '_bbp_forum_id',
			//'callback_method' => 'callback_topicid_to_forumid'
			'callback_method' => 'callback_forumid'
		);

		// Reply parent topic id (If no parent, then 0. Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Topic_ID',
			'to_type'         => 'reply',
			'to_fieldname'    => '_bbp_topic_id',
			'callback_method' => 'callback_topicid'
		);

		// Reply author ip (Stored in postmeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'IP_addr',
			'to_type'         => 'reply',
			'to_fieldname'    => '_bbp_author_ip'
		);

		// Reply author.
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Author_ID',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_author',
			'callback_method' => 'callback_userid'
		);

		// Reply title.
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Subject',
            'join_tablename'  => 'tblThread',
            'join_type'       => 'LEFT',
            'join_expression' => 'ON tblTopic.Topic_ID = tblThread.Topic_ID',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_title'
		);

        /*
		// Reply slug (Clean name to avoid conflicts)
		$this->field_map[] = array(
			'from_tablename'  => 'replies_table',
			'from_fieldname'  => 'the_reply_slug',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_name',
			'callback_method' => 'callback_slug'
		);
        */

		// Reply content.
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_content',
			'callback_method' => 'callback_html'
		);

        /*
		// Reply order.
		$this->field_map[] = array(
			'from_tablename'  => 'replies_table',
			'from_fieldname'  => 'the_reply_order',
			'to_type'         => 'reply',
			'to_fieldname'    => 'menu_order'
		);
        */

		// Reply parent topic id (If no parent, then 0)
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Topic_ID',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_parent',
			'callback_method' => 'callback_topicid'
		);

		// Reply dates.
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_date',
			'callback_method' => 'callback_datetime'
		);
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_date_gmt',
			'callback_method' => 'callback_datetime'
		);

		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_modified',
			'callback_method' => 'callback_datetime'
		);
		$this->field_map[] = array(
			'from_tablename'  => 'tblThread',
			'from_fieldname'  => 'Message_date',
			'to_type'         => 'reply',
			'to_fieldname'    => 'post_modified_gmt',
			'callback_method' => 'callback_datetime'
		);

		// Setup any table joins needed for the reply section
        /*
		$this->field_map[] = array(
			'from_tablename'  => 'tblTopic',
			'from_fieldname'  => 'Topic_ID',
			'join_tablename'  => 'tblThread',
			'join_type'       => 'INNER',
			'join_expression' => 'USING tblTopic.Topic_ID = tblThread.Topic_ID',
			//'from_expression' => 'WHERE tblTopic.Start_Thread_ID != 0',
			'to_type'         => 'reply'
		);
        */

		/** User Section ******************************************************/

		// Setup table joins for the user section at the base of this section

		// Store old User id (Stored in usermeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Author_ID',
			'to_type'         => 'user',
			'to_fieldname'    => '_bbp_user_id'
		);

		// Store old User password (Stored in usermeta serialized with salt)
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Password',
			'to_type'         => 'user',
			'to_fieldname'    => '_bbp_password',
			'callback_method' => 'callback_savepass'
		);

		// Store old User Salt (This is only used for the SELECT row info for the above password save)
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Salt',
			'to_type'         => 'user',
			'to_fieldname'    => ''
		);

		// User password verify class (Stored in usermeta for verifying password)
		$this->field_map[] = array(
			'to_type'         => 'user',
			'to_fieldname'    => '_bbp_class',
			'default'        => 'WebWiz10'
		);

		// User name.
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Username',
			'to_type'         => 'user',
			'to_fieldname'    => 'user_login'
		);

		// User nice name.
		/*
		$this->field_map[] = array(
			'from_tablename' => 'tblAuthor',
			'from_fieldname' => 'Username',
			'to_type'        => 'user',
			'to_fieldname'   => 'user_nicename'
		);
		*/

		// User email.
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Author_email',
			'to_type'         => 'user',
			'to_fieldname'    => 'user_email'
		);

		// User homepage.
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Homepage',
			'to_type'         => 'user',
			'to_fieldname'    => 'user_url'
		);

		// User registered.
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Join_date',
			'to_type'         => 'user',
			'to_fieldname'    => 'user_registered',
			'callback_method' => 'callback_datetime'
		);

		// User status.
		$this->field_map[] = array(
			'from_tablename' => 'tblAuthor',
			'from_fieldname' => 'Group_ID',
			'to_type'        => 'user',
			'to_fieldname'   => 'user_status'
		);

		// User display name.
		$this->field_map[] = array(
			'from_tablename' => 'tblAuthor',
			'from_fieldname' => 'Real_name',
			'to_type'        => 'user',
			'to_fieldname'   => 'display_name'
		);

		// User AIM (Stored in usermeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'AIM',
			'to_type'         => 'user',
			'to_fieldname'    => 'aim'
		);

		// User Yahoo (Stored in usermeta)
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Yahoo',
			'to_type'         => 'user',
			'to_fieldname'    => 'yim'
		);

		// User Jabber (Stored in usermeta)
		$this->field_map[] = array(
			'from_tablename' => 'tblAuthor',
			'from_fieldname' => 'ICQ',
			'to_type'        => 'user',
			'to_fieldname'   => 'jabber'
		);
		
		// Store Avatar Filename (Stored in usermeta)
		$this->field_map[] = array(
			'from_tablename' => 'tblAuthor',
			'from_fieldname' => 'Avatar',
			'to_type'        => 'user',
			'to_fieldname'   => '_bbp_webwiz_user_avatar',
			'callback_method' => 'callback_avatar'
		);

		// Store Signature (Stored in usermeta)
		$this->field_map[] = array(
			'from_tablename' => 'tblAuthor',
			'from_fieldname' => 'Signature',
			'to_type'        => 'user',
			'to_fieldname'   => '_bbp_webwiz_user_sig',
			'callback_method' => 'callback_html'
		);

		// Store Interests (Stored in usermeta)
		$this->field_map[] = array(
			'from_tablename' => 'tblAuthor',
			'from_fieldname' => 'Interests',
			'to_type'        => 'user',
			'to_fieldname'   => '_bbp_webwiz_user_interests'
		);

        /*
		// Setup any table joins needed for the user section
		$this->field_map[] = array(
			'from_tablename'  => 'tblAuthor',
			'from_fieldname'  => 'Author_ID',
			'join_tablename'  => 'users_table',
			'join_type'       => 'INNER',
			'join_expression' => 'USING users_profile_table.the_user_id = users_table.the_user_id',
			'from_expression' => 'WHERE users_table.the_user_id != -1',
			'to_type'         => 'user'
		);
        */
	}

	/**
	 * This method allows us to indicates what is or is not converted for each
	 * converter.
	 */
	public function info() {
		return '';
	}

	/**
	 * This method is to save the salt and password together.  That
	 * way when we authenticate it we can get it out of the database
	 * as one value. Array values are auto sanitized by WordPress.
	 */
	public function callback_savepass( $field, $row ) {
		$pass_array = array( 'hash' => $field, 'salt' => $row['Salt'] );
		return $pass_array;
	}

	/**
	 * This method is to take the pass out of the database and compare
	 * to a pass the user has typed in.
	 */
	public function authenticate_pass( $password, $serialized_pass ) {
		$pass_array = unserialize( $serialized_pass );
   		return ww_HashEncode($password.$pass_array['salt']) == $pass_array['hash'];
	}
	/**
	 * Translate the topic status from phpBB v3.x numeric's to WordPress's strings.
	 *
	 * @param int $status phpBB v3.x numeric topic status
	 * @return string WordPress safe
	 */
	public function callback_topic_status( $locked = 0 ) {
		switch ( $locked ) {
			case 1 :
				$status = 'closed';
				break;

			case 0 :
			default :
				$status = 'publish';
				break;
		}
		return $status;
	}

	/**
	 * Translate the topic sticky status type from phpBB 3.x numeric's to WordPress's strings.
	 *
	 * @param int $status phpBB 3.x numeric forum type
	 * @return string WordPress safe
	 */
	public function callback_sticky_status( $priority = 0 ) {
		switch ( $priority ) {
			case 3 :
				$status = 'super-sticky'; // vBulletin Super Sticky 'sticky = 2'
				break;
                
			case 2 :
			case 1 :
				$status = 'sticky';       // PunBB Sticky 'topic_sticky = 1'
				break;

			case 0  :
			default :
				$status = 'normal';       // PunBB Normal Topic 'topic_sticky = 0'
				break;
		}
		return $status;
	}
    
	protected function callback_avatar( $avatar ) {
		
		$webwiz_markup = preg_replace( '/\<img src="uploads\/(.*?)" (.*?) \/>/' , '<img src="\/webwiz\/uploads\/$1" $2 >' , $webwiz_markup );
		
	}

	
    	/**
	 * This callback:
	 *
	 * - turns off smiley parsing
	 * - processes any custom parser.php attributes
	 * - decodes necessary HTML entities
	 */
	 /*
	protected function callback_html( $field ) {
		require_once( bbpress()->admin->admin_dir . 'parser.php' );
		$bbcode = BBCode::getInstance();
		$bbcode->enable_smileys = true;
		$bbcode->smiley_regex   = true;
		return html_entity_decode( $bbcode->Parse( $field ) );
	}
	*/    
    
    /**
	 * This callback processes any custom parser.php attributes and custom HTML code with preg_replace
	 */
	protected function callback_html( $field ) {
		// Strip any custom HTML not supported by parser.php first from $field before parsing $field to parser.php
		$webwiz_markup = $field;
		$webwiz_markup = html_entity_decode( $webwiz_markup );

		// Replace any known smilies from path 'smileys\/smiley1\.gif' with the equivelant WordPress Smilie
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley1\.gif(.*?)\" \/>/',     	':-)' ,    	$webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley2\.gif(.*?)\" \/>/',     	';)' ,     	$webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley3\.gif(.*?)\" \/>/',     	':o' ,     	$webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley4\.gif(.*?)\" \/>/',     	':D' ,     	$webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley5\.gif(.*?)\" \/>/',     	':?' ,     	$webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley6\.gif(.*?)\" \/>/',     	':(' ,     	$webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley7\.gif(.*?)\" \/>/',     	':x' ,     	$webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley8\.gif(.*?)\" \/>/',     	':o)',   	$webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley9\.gif(.*?)\" \/>/',     	':$' ,     	$webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley10\.gif(.*?)\" \/>/',     	':*:' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley11\.gif(.*?)\" \/>/',     	':xx(' ,    $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley12\.gif(.*?)\" \/>/',     	':|)' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley13\.gif(.*?)\" \/>/',     	':V:' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley14\.gif(.*?)\" \/>/',     	':^:' ,     $webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley15\.gif(.*?)\" \/>/',     	':evil:' ,  $webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley16\.gif(.*?)\" \/>/',     	':cool:' ,  $webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley17\.gif(.*?)\" \/>/',     	':P' ,     	$webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley18\.gif(.*?)\" \/>/',     	':8(' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley19\.gif(.*?)\" \/>/',     	':^(',   	$webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley20\.gif(.*?)\" \/>/',     	':Y:' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley21\.gif(.*?)\" \/>/',     	':N:' ,     $webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley22\.gif(.*?)\" \/>/',     	':|' ,     	$webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley23\.gif(.*?)\" \/>/',     	':-B' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley24\.gif(.*?)\" \/>/',     	':[]' ,     $webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley25\.gif(.*?)\" \/>/',     	':?:' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley26\.gif(.*?)\" \/>/',     	':pinch:' , $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley27\.gif(.*?)\" \/>/',     	':heart:' , $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley28\.gif(.*?)\" \/>/',     	':brokenheart:' ,     	$webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley29\.gif(.*?)\" \/>/',     	':8-}' ,    $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley30\.gif(.*?)\" \/>/',     	':@)' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley31\.gif(.*?)\" \/>/',     	':>:D<' ,   $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley32\.gif(.*?)\" \/>/',     	':clap:' ,  $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley33\.gif(.*?)\" \/>/',     	':%:' ,     $webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley34\.gif(.*?)\" \/>/',     	':!:' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley35\.gif(.*?)\" \/>/',     	':XXX:' ,   $webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley36\.gif(.*?)\" \/>/',     	':lol:' ,  	$webwiz_markup );
		$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley37\.gif(.*?)\" \/>/',     	':!:' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley38\.gif(.*?)\" \/>/',     	':*:' ,     $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley39\.gif(.*?)\" \/>/',     	':+o(' ,    $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley40\.gif(.*?)\" \/>/',     	':party:' , $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley41\.gif(.*?)\" \/>/',     	':beer:' ,  $webwiz_markup );
		//$webwiz_markup = preg_replace( '/\<img src="smileys\/smiley42\.gif(.*?)\" \/>/',     	':shake:' , $webwiz_markup );

		// Update URL's for remaining smileys to "/webwiz/uploads" -- they are "archived"
		$webwiz_markup = preg_replace( '/\<img src="smileys\/(.*?)" (.*?) \/>/' , '<img src="\/webwiz\/smileys\/$1" $2 >' , $webwiz_markup );
		
		// Update URL's for existing images to "/webwiz/uploads" -- they are "archived"
		$webwiz_markup = preg_replace( '/\<img src="uploads\/(.*?)" (.*?) \/>/' , '<img src="\/webwiz\/uploads\/$1" $2 >' , $webwiz_markup );
		
		// Replace '<p>&nbsp;</p>' with '<p>&nbsp;</p>'
		//$webwiz_markup = preg_replace ( '/\n(&nbsp;|[\s\p{Z}\xA0\x{00A0}]+)\r/', '<br>', $webwiz_markup );

		// Now that WebWiz's custom HTML codes have been stripped put the cleaned HTML back in $field
		$field = $webwiz_markup;

		// Parse out any bbCodes with the BBCode 'parser.php'
		require_once( bbpress()->admin->admin_dir . 'parser.php' );
		$bbcode = BBCode::getInstance();
		$bbcode->enable_smileys = false;
		$bbcode->smiley_regex   = false;
		return html_entity_decode( $bbcode->Parse( $field ) );
	}
}
