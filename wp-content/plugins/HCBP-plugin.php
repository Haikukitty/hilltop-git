<?php
/*
/*
Plugin Name: Hospital Community Benefit Comparison Table
Description: Hilltop-specific states comparison table for Hospital Community Benefit Programs nationwide.
Author: Mia Jordan
Version: 1.0
Author URI:  https://bluetabby.com

 */

/**
    * PART 1. Defining Custom Database Table
    * ============================================================================
    *
    * In this part you are going to define custom database table,
    * create it, update, and fill with some dummy data
    *
    * http://codex.wordpress.org/Creating_Tables_with_Plugins
    *
    * In case your are developing and want to check plugin use:
    *
    * DROP TABLE IF EXISTS wp_statesTable;
    * DELETE FROM wp_options WHERE option_name = 'hcbp_install_data';
    *
    * to drop table and option
    */

/**
    * $hcbp_db_version - holds current database version
    * and used on plugin update to sync database tables
    */
global $hcbp_db_version;
$hcbp_db_version = '1.1'; // version changed from 1.0 to 1.1

/**
    * register_activation_hook implementation
    *
    * will be called when user activates plugin first time
    * must create needed database tables
    */
function hcbp_install()
{
    global $wpdb;
    global $hcbp_db_version;

    $table_name = '{$wpdb->prefix}statesTable'; // do not forget about tables prefix

    // sql to create your table
    // NOTICE that:
    // 1. each field MUST be in separate line
    // 2. There must be two spaces between PRIMARY KEY and its name
    //    Like this: PRIMARY KEY[space][space](id)
    // otherwise dbDelta will not work
    $sql = "CREATE TABLE " . $table_name . " (
        stID int(10) NOT NULL UNSIGNED, 
            stateID varchar(50) NOT NULL,
            stateDesc VARCHAR(50) NOT NULL,
            cbr int(1) NOT NULL UNSIGNED  DEFAULT '0',
            cbr_text LONGTEXT,
            mmcbr int(1) NOT NULL UNSIGNED DEFAULT '0',
            mmcbr_text LONGTEXT,
            cbrr int(1) NOT NULL UNSIGNED DEFAULT '0',
            cbrr_text LONGTEXT,
            chna int(1) NOT NULL UNSIGNED DEFAULT '0',            
            chna_text LONGTEXT,
            cbpis int(1) NOT NULL UNSIGNED DEFAULT '0',
            cbpis_text LONGTEXT,
            cbpis int(1) NOT NULL UNSIGNED DEFAULT '0',
            cbpis_text LONGTEXT,
            fap int(1) NOT NULL UNSIGNED DEFAULT '0',
            fap_text LONGTEXT,
            fapd int(1) NOT NULL UNSIGNED DEFAULT '0',
            fapd_text LONGTEXT,
            lcbc int(1) NOT NULL UNSIGNED DEFAULT '0',
            lcbc_text LONGTEXT,
            ite int(1) NOT NULL UNSIGNED DEFAULT '0',
            ite_text LONGTEXT,
            pte int(1) NOT NULL UNSIGNED DEFAULT '0',
            pte_text LONGTEXT,
            ste int(1) NOT NULL UNSIGNED DEFAULT '0',
            ste_text LONGTEXT,
            
            PRIMARY KEY  (stID)

    );";

    // we do not execute sql directly
    // we are calling dbDelta which cant migrate database
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // save current database version for later use (on upgrade)
    add_option('hcbp_db_version', $hcbp_db_version);

    /**
        * [OPTIONAL] Example of updating to 1.1 version
        *
        * If you develop new version of plugin
        * just increment $hcbp_db_version variable
        * and add following block of code
        *
        * must be repeated for each new version
        * in version 1.1 we change email field
        * to contain 200 chars rather 100 in version 1.0
        * and again we are not executing sql
        * we are using dbDelta to migrate table changes
        */
    $installed_ver = get_option('hcbp_db_version');
    if ($installed_ver != $hcbp_db_version) {
        $sql = "CREATE TABLE " . $table_name . " (
             stID int(10) NOT NULL UNSIGNED, 
            stateID varchar(50) NOT NULL,
            stateDesc VARCHAR(50) NOT NULL,
            cbr int(1) NOT NULL UNSIGNED  DEFAULT '0',
            cbr_text LONGTEXT,
            mmcbr int(1) NOT NULL UNSIGNED DEFAULT '0',
            mmcbr_text LONGTEXT,
            cbrr int(1) NOT NULL UNSIGNED DEFAULT '0',
            cbrr_text LONGTEXT,
            chna int(1) NOT NULL UNSIGNED DEFAULT '0',            
            chna_text LONGTEXT,
            cbpis int(1) NOT NULL UNSIGNED DEFAULT '0',
            cbpis_text LONGTEXT,
            cbpis int(1) NOT NULL UNSIGNED DEFAULT '0',
            cbpis_text LONGTEXT,
            fap int(1) NOT NULL UNSIGNED DEFAULT '0',
            fap_text LONGTEXT,
            fapd int(1) NOT NULL UNSIGNED DEFAULT '0',
            fapd_text LONGTEXT,
            lcbc int(1) NOT NULL UNSIGNED DEFAULT '0',
            lcbc_text LONGTEXT,
            ite int(1) NOT NULL UNSIGNED DEFAULT '0',
            ite_text LONGTEXT,
            pte int(1) NOT NULL UNSIGNED DEFAULT '0',
            pte_text LONGTEXT,
            ste int(1) NOT NULL UNSIGNED DEFAULT '0',
            ste_text LONGTEXT,
            
            PRIMARY KEY  (stID)
                    );";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        // notice that we are updating option, rather than adding it
        update_option('hcbp_db_version', $hcbp_db_version);
    }
}

register_activation_hook(__FILE__, 'hcbp_install');

/**
    * register_activation_hook implementation
    *
    * [OPTIONAL]
    * additional implementation of register_activation_hook
    * to insert some dummy data
    */
//function hcbp_install_data()
//{
//    global $wpdb;

//    $table_name = $wpdb->prefix . 'statesTable'; // do not forget about tables prefix

 //   $wpdb->insert($table_name, array(
 //       'name' => 'Alex',
 //       'email' => 'alex@example.com',
 //       'age' => 25
 //   ));
 //   $wpdb->insert($table_name, array(
//        'name' => 'Maria',
 //       'email' => 'maria@example.com',
//        'age' => 22
 //   ));
//}

register_activation_hook(__FILE__, 'hcbp_install_data');

/**
    * Trick to update plugin database, see docs
    */
function hcbp_update_db_check()
{
    global $hcbp_db_version;
    if (get_site_option('hcbp_db_version') != $hcbp_db_version) {
        hcbp_install();
    }
}

add_action('plugins_loaded', 'hcbp_update_db_check');

/**
    * PART 2. Defining Custom Table List
    * ============================================================================
    *
    * In this part you are going to define custom table list class,
    * that will display your database records in nice looking table
    *
    * http://codex.wordpress.org/Class_Reference/WP_List_Table
    * http://wordpress.org/extend/plugins/custom-list-table-example/
    */

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
    * hcbp_List_Table class that will display our custom table
    * records in nice table
    */
class hcbp_List_Table extends WP_List_Table
{
    /**
        * [REQUIRED] You must declare constructor and give some basic params
        */
    function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular' => __( 'state', 'hcbp' ), //singular name of the listed records
			'plural'   => __( 'states', 'hcbp' ), //plural name of the listed records
        ));
    }

    /**
        * [REQUIRED] this is a default column renderer
        *
        * @param $item - row (key, value array)
        * @param $column_name - string (key)
        * @return HTML
        */
    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    /**
        * [OPTIONAL] this is example, how to render specific column
        *
        * method name must be like this: "column_[column_name]"
        *
        * @param $item - row (key, value array)
        * @return HTML
        */
   // function column_stID($item)
  //  {
  //      return '<em>' . $item['age'] . '</em>';
 //   }

    /**
        * [OPTIONAL] this is example, how to render column with actions,
        * when you hover row "Edit | Delete" links showed
        *
        * @param $item - row (key, value array)
        * @return HTML
        */
    function column_stateDesc($item)
    {
        // links going to /admin.php?page=[your_plugin_page][&other_params]
        // notice how we used $_REQUEST['page'], so action will be done on curren page
        // also notice how we use $this->_args['singular'] so in this example it will
        // be something like &state=2
        $actions = array(
            'edit' => sprintf('<a href="?page=states_form&stID=%s">%s</a>', $item['stID'], __('Edit', 'hcbp')),
            'delete' => sprintf('<a href="?page=%s&action=delete&stID=%s">%s</a>', $_REQUEST['page'], $item['stID'], __('Delete', 'hcbp')),
        );

        return sprintf('%s %s',
            $item['stateDesc'],
            $this->row_actions($actions)
        );
    }

    /**
        * [REQUIRED] this is how checkbox column renders
        *
        * @param $item - row (key, value array)
        * @return HTML
        */
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="stID[]" value="%s" />',
            $item['stID']
        );
    }

    /**
        * [REQUIRED] This method return columns to display in table
        * you can skip columns that you do not want to show
        * like content, or description
        *
        * @return array
        */
    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
            'stID'    => __( 'stID', 'hcbp' ),
			'stateDesc' => __( 'State', 'hcbp' ),
			'cbr' => __( 'cbr', 'hcbp' ),
			'cbr_text'    => __( 'CBR', 'hcbp' ),
			'mmcbr' => __( 'mmcbr', 'hcbp' ),
			'mmcbr_text'    => __( 'MMCBR', 'hcbp' ),
			'cbrr' => __( 'cbrr', 'hcbp' ),
			'cbrr_text'    => __( 'CBRR', 'hcbp' ),
			'chna' => __( 'chna', 'hcbp' ),
			'chna_text'    => __( 'CHNA', 'hcbp' ),
			'cbpis' => __( 'cbpis', 'hcbp' ),
			'cbpis_text'    => __( 'CBPIS', 'hcbp' ),
			'fap' => __( 'fap', 'hcbp' ),
			'fap_text'    => __( 'FAP', 'hcbp' ),
			'fapd' => __( 'fapd', 'hcbp' ),
			'fapd_text'    => __( 'FAPD', 'hcbp' ),
			'lcbc' => __( 'lcbc', 'hcbp' ),
			'lcbc_text'    => __( 'LCBC', 'hcbp' ),
			'ite' => __( 'ite', 'hcbp' ),
			'ite_text'    => __( 'ITE', 'hcbp' ),
			'pte' => __( 'pte', 'hcbp' ),
			'pte_text'    => __( 'PTE', 'hcbp' ),
			'ste' => __( 'ste', 'hcbp' ),
			'ste_text'    => __( 'STE', 'hcbp' )
        );
        return $columns;
    }

    /**
        * [OPTIONAL] This method return columns that may be used to sort table
        * all strings in array - is column names
        * notice that true on name column means that its default sort
        *
        * @return array
        */
    function get_sortable_columns()
    {
        $sortable_columns = array(
           'stID' => array( 'stID', true ),
			'stateDesc' => array( 'stateDesc', true ),
				'cbr' => array( 'cbr', false ),
			'cbr_text'    => array( 'CBR', false ),
			'mmcbr' => array( 'mmcbr', false ),
			'mmcbr_text'    => array( 'MMCBR', false ),
			'cbrr' =>array( 'cbrr', false ),
			'cbrr_text'    => array( 'CBRR', false ),
			'chna' => array( 'chna', false ),
			'chna_text'    => array( 'CHNA', false ),
			'cbpis' => array( 'cbpis', false ),
			'cbpis_text'    => array( 'CBPIS', false ),
			'fap' => array( 'fap', false ),
			'fap_text'    => array( 'FAP', false ),
			'fapd' => array( 'fapd', false ),
			'fapd_text'    => array( 'FAPD', false ),
			'lcbc' => array( 'lcbc', false ),
			'lcbc_text'    => array( 'LCBC', false ),
			'ite' => array( 'ite', false ),
			'ite_text'    => array( 'ITE', false ),
			'pte' => array( 'pte', false ),
			'pte_text'    =>array( 'PTE', false ),
			'ste' => array( 'ste', false ),
			'ste_text'    => array( 'STE', false )

        );
        return $sortable_columns;
    }

    /**
        * [OPTIONAL] Return array of bult actions if has any
        *
        * @return array
        */
    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    /**
        * [OPTIONAL] This method processes bulk actions
        * it can be outside of class
        * it can not use wp_redirect coz there is output already
        * in this example we are processing delete action
        * message about successful deletion will be shown on page in next part
        */
    function process_bulk_action()
    {
        global $wpdb;
        $table_name = '{$wpdb->prefix}statesTable'; // do not forget about tables prefix

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['stID']) ? $_REQUEST['stID'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM {$wpdb->prefix}statesTable WHERE stID IN($ids)");
            }
        }
    }
    
    
  

    /**
        * [REQUIRED] This is the most important method
        *
        * It will get rows from database and prepare them to be showed in table
        */
    function prepare_items()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'statesTable'; // do not forget about tables prefix

        $per_page = 30; // constant, how much records will be shown per page

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // will be used in pagination settings
        $total_items = $wpdb->get_var("SELECT COUNT(stID) FROM $table_name");

        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? ($per_page * max(0, intval($_REQUEST['paged']) - 1)) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'name';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);

        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    }
}

/**
    * PART 3. Admin page
    * ============================================================================
    *
    * In this part you are going to add admin page for custom table
    *
    * http://codex.wordpress.org/Administration_Menus
    */

/**
    * admin_menu hook implementation, will add pages to list states and to add new one
    */
function hcbp_admin_menu()
{
    add_menu_page(__('States Table', 'hcbp'), __('States Table', 'hcbp'), 'activate_plugins', 'states', 'hcbp_states_page_handler');
    add_submenu_page('states', __('States Table', 'hcbp'), __('States Table', 'hcbp'), 'activate_plugins', 'states', 'hcbp_states_page_handler');
    // add new will be described in next part
    add_submenu_page('states', __('Add new', 'hcbp'), __('Add new', 'hcbp'), 'activate_plugins', 'states_form', 'hcbp_states_form_page_handler');
}

add_action('admin_menu', 'hcbp_admin_menu');

/**
    * List page handler
    *
    * This function renders our custom table
    * Notice how we display message about successfull deletion
    * Actualy this is very easy, and you can add as many features
    * as you want.
    *
    * Look into /wp-admin/includes/class-wp-*-list-table.php for examples
    */
function hcbp_states_page_handler()
{
    global $wpdb;

    $table = new hcbp_List_Table();
   // $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'hcbp'), count($_REQUEST['stID'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('states', 'hcbp')?> <a class="add-new-h2"
                                    href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=states_form');?>"><?php _e('Add new', 'hcbp')?></a>
    </h2>
    <?php echo $message; ?>


 

<h4>Click on a state below to edit that state's data.</h4>
 
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2300">Alabama</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2301">Alaska</a><br>
   
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2302">Arizona</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2303">Arkansas</a><br>
  
   
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2304">California</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2305">Colorado</a><br>
  
  
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2306">Conecticut</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2307">Delaware</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2308">Florida</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2309">Georgia</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2310">Hawaii</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2311">Idaho</a><br>
  
   <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2312">Illinois</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2313">Indiana</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2314">Iowa</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2315">Kansas</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2316">Kentucky</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2317">Louisiana</a><br>
  
     <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2318">Maine</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2319">Maryland</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2320">Massachusetts</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2321">Michigan</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2322">Minnesota</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2323">Mississippi</a><br>
  
   <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2324">Missouri</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2325">Montana</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2326">Nebraska</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2327">Nevada</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2328">New Hampshire</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2329">New Jersey</a><br>
  
     <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2330">New Mexico</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2331">New York</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2332">North Carolina</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2333">North Dakota</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2334">Ohio</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2335">Oklahoma</a><br>
  
       <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2336">Oregon</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2337">Pennsylvania</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2338">Rhode Island</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2339">South Caolina</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2340">South Dakota</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2341">Tennessee</a><br>
  
       <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2342">Texas</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2343">Utah</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2344">Vermont</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2345">Virginia</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2346">Washington</a><br>
  <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2347">West Virginia</a><br>
  
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2348">Wisconsin</a><br>
    <a href="http://dev-hilltop.pantheonsite.io/wp-admin/admin.php?page=states_form&stID=2349">Wyoming</a><br>


</div>
<?php
}

/**
    * PART 4. Form for adding andor editing row
    * ============================================================================
    *
    * In this part you are going to add admin page for adding andor editing items
    * You cant put all form into this function, but in this example form will
    * be placed into meta box, and if you want you can split your form into
    * as many meta boxes as you want
    *
    * http://codex.wordpress.org/Data_Validation
    * http://codex.wordpress.org/Function_Reference/selestatesTabled
    */

/**
    * Form page handler checks is there some data posted and tries to save it
    * Also it renders basic wrapper in which we are callin meta box render
    */
function hcbp_states_form_page_handler()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'statesTable'; // do not forget about tables prefix

    $message = '';
    $notice = '';

    // this is default $item which will be used for new records
    $default = array(
        'stID' => 0,
        'stateID' => '',
        'stateDesc' => '',
        'cbr' => '0',
        'cbr_text'=> '',
        'mmcbr' => '0',
        'mmcbr_text'=> '',
        'cbrr' => '0',
        'cbrr_text'=> '',
        'chna' => '0',
        'chna_text'=> '',
        'cbpis' => '0',
        'cbpis_text'=> '',
        'fap' => '0',
        'fap_text'=> '',
        'fapd' => '0',
        'fapd_text'=> '',
        'lcbc' => '0',
        'lcbc_text'=> '',
        'ite' => '0',
        'ite_text'=> '',
        'pte' => '0',
        'pte_text'=> '',
        'ste' => '0',
        'ste_text'=> '',
    );

    // here we are verifying does this request is post back and have correct nonce
    if (wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
        // combine our default item with request params
        $item = shortcode_atts($default, $_REQUEST);
        // validate data, and if all ok save item to database
        // if id is zero insert otherwise update
        $item_valid = hcbp_validate_state($item);
        if ($item_valid === true) {
            if ($item['stID'] == 0) {
                $result = $wpdb->insert($table_name, $item);
                $item['stID'] = $wpdb->insert_id;
                if ($result) {
                    $message = __('Item was successfully saved', 'hcbp');
                } else {
                    $notice = __('There was an error while saving item', 'hcbp');
                }
            } else {
                $result = $wpdb->update($table_name, $item, array('stID' => $item['stID']));
                if ($result) {
                    $message = __('Item was successfully updated', 'hcbp');
                } else {
                    $notice = __('There was an error while updating item', 'hcbp');
                }
            }
        } else {
            // if $item_valid not true it contains error message(s)
            $notice = $item_valid;
        }
    }
    else {
        // if this is not post back we load item to edit or give new one to create
        $item = $default;
        if (isset($_REQUEST['stID'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE stID = %d", $_REQUEST['stID']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'hcbp');
            }
        }
    }

    // here we adding our custom meta box
    add_meta_box('states_form_meta_box', 'State data', 'hcbp_states_form_meta_box_handler', 'state', 'normal', 'default');

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('State', 'hcbp')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=states');?>"><?php _e('back to list', 'hcbp')?></a>
    </h2>

    <?php if (!empty($notice)): ?>
    <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($message)): ?>
    <div id="message" class="updated"><p><?php echo $message ?></p></div>
    <?php endif;?>

    <form id="form" method="POST">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
        <?php /* NOTICE: here we storing id to determine will be item added or updated */ ?>
        <input type="hidden" name="stID" value="<?php echo $item['stID'] ?>"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <?php /* And here we call our custom meta box */ ?>
                    <?php do_meta_boxes('state', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'hcbp')?>" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}

/**
    * This function renders our custom meta box
    * $item is row
    *
    * @param $item
    */
function hcbp_states_form_meta_box_handler($item)
{
    ?>

<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
    <tbody>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="stateID"><?php _e('stateID', 'hcbp')?></label>
        </th>
        <td>
            <input id="stateID" name="stateID" type="text" style="width: 95%" value="<?php echo esc_attr($item['stateID'])?>"
                    size="50"  placeholder="<?php _e('State Abbreviation', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="stateDesc"><?php _e('stateDesc', 'hcbp')?></label>
        </th>
        <td>
            <input id="stateDesc" name="stateDesc" type="text" style="width: 95%" value="<?php echo $item['stateDesc']; ?>"
                    size="50"  placeholder="<?php _e('State Name', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="cbr"><?php _e('cbr', 'hcbp')?></label>
        </th>
        <td>
            <input id="cbr" name="cbr" type="number" style="width: 95%" value="<?php echo $item['cbr']; ?>"
                    size="50"  placeholder="<?php _e('cbr', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="cbr_text"><?php _e('cbr_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="cbr_text" name="cbr_text" type="text" style="width: 95%" value="<?php echo htmlentities($item['cbr_text']); ?>"
                    size="50"  placeholder="<?php _e('CBR', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="mmcbr"><?php _e('mmcbr', 'hcbp')?></label>
        </th>
        <td>
            <input id="mmcbr" name="mmcbr" type="number" style="width: 95%" value="<?php echo $item['mmcbr']; ?>"
                    size="50"  placeholder="<?php _e('mmcbr', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="mmcbr_text"><?php _e('mmcbr_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="mmcbr_text" name="mmcbr_text" type="text" style="width: 95%" value="<?php echo htmlentities($item['mmcbr_text']); ?>"
                    size="50"  placeholder="<?php _e('MMCBR', 'hcbp')?>" required>
        </td>
    </tr>
    
    
      <tr class="form-field">
        <th valign="top" scope="row">
            <label for="cbrr"><?php _e('cbrr', 'hcbp')?></label>
        </th>
        <td>
            <input id="cbrr" name="cbrr" type="number" style="width: 95%" value="<?php echo $item['cbrr'];?>"
                    size="50"  placeholder="<?php _e('cbrr', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="cbrr_text"><?php _e('cbrr_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="cbrr_text" name="cbrr_text" type="text" style="width: 95%" value="<?php echo htmlentities($item['cbrr_text']); ?>"
                    size="50" placeholder="<?php _e('CBRR', 'hcbp')?>" required>
        </td>
    </tr>
    
    
         <tr class="form-field">
        <th valign="top" scope="row">
            <label for="chna"><?php _e('chna', 'hcbp')?></label>
        </th>
        <td>
            <input id="chna" name="chna" type="number" style="width: 95%" value="<?php echo $item['chna']; ?>"
                    size="50"  placeholder="<?php _e('chna', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="chna_text"><?php _e('chna_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="chna_text" name="chna_text" type="text" style="width: 95%" value="<?php echo htmlentities($item['chna_text']); ?>"
                    size="150"  placeholder="<?php _e('CHNA', 'hcbp')?>" >
        </td>
    </tr>
    
         <tr class="form-field">
        <th valign="top" scope="row">
            <label for="cbpis"><?php _e('cbpis', 'hcbp')?></label>
        </th>
        <td>
            <input id="cbpis" name="cbpis" type="number" style="width: 95%" value="<?php echo $item['cbpis']; ?>"
                    size="150"  placeholder="<?php _e('cbpis', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="cbpis_text"><?php _e('cbpis_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="cbpis_text" name="cbpis_text" type="text" style="width: 95%" value="<?php echo htmlentities($item['cbpis_text']); ?>"
                    size="50"  placeholder="<?php _e('CBPIS', 'hcbp')?>" required>
        </td>
    </tr>
    
          <tr class="form-field">
        <th valign="top" scope="row">
            <label for="fap"><?php _e('fap', 'hcbp')?></label>
        </th>
        <td>
            <input id="fap" name="fap" type="number" style="width: 95%" value="<?php echo htmlentities($item['fap'])?>"
                    size="50"  placeholder="<?php _e('fap', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="fap_text"><?php _e('fap_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="fap_text" name="fap_text" type="text" style="width: 95%" value="<?php echo htmlentities($item['fap_text']); ?>"
                    size="50"  placeholder="<?php _e('FAP', 'hcbp')?>" required>
        </td>
    </tr>
    
           <tr class="form-field">
        <th valign="top" scope="row">
            <label for="fapd"><?php _e('fapd', 'hcbp')?></label>
        </th>
        <td>
            <input id="fapd" name="fapd" type="number" style="width: 95%" value="<?php echo $item['fapd']; ?>"
                    size="50"  placeholder="<?php _e('fapd', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="fapd_text"><?php _e('fapd_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="fapd_text" name="fapd_text" type="text" style="width: 95%" value="<?php echo htmlentities($item['fapd_text']); ?>"
                    size="50"  placeholder="<?php _e('FAPD', 'hcbp')?>" >
        </td>
    </tr>
    
         <tr class="form-field">
        <th valign="top" scope="row">
            <label for="lcbc"><?php _e('lcbc', 'hcbp')?></label>
        </th>
        <td>
            <input id="lcbc" name="lcbc" type="number" style="width: 95%" value="<?php echo htmlentities($item['lcbc'])?>"
                    size="50"  placeholder="<?php _e('lcbc', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="lcbc_text"><?php _e('lcbc_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="lcbc_text" name="lcbc_text" type="text" style="width: 95%" value="<?php echo htmlentities($item['lcbc_text']); ?>"
                    size="50"  placeholder="<?php _e('LCBC', 'hcbp')?>" >
        </td>
    </tr>
    
         <tr class="form-field">
        <th valign="top" scope="row">
            <label for="ite"><?php _e('ite', 'hcbp')?></label>
        </th>
        <td>
            <input id="ite" name="ite" type="number" style="width: 95%" value="<?php echo htmlentities($item['ite'])?>"
                    size="50"  placeholder="<?php _e('ite', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="ite_text"><?php _e('ite_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="ite_text" name="ite_text" type="text" style="width: 95%;word-break: break-word;" value="<?php echo htmlentities($item['ite_text']); ?>"
                    size="50"  placeholder="<?php _e('ITE', 'hcbp')?>" >
                            </td>
    </tr>
    
    
       <tr class="form-field">
        <th valign="top" scope="row">
            <label for="pte"><?php _e('pte', 'hcbp')?></label>
        </th>
        <td>
            <input id="pte" name="pte" type="number" style="width: 95%" value="<?php echo htmlentities($item['pte'])?>"
                    size="50"  placeholder="<?php _e('pte', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="pte_text"><?php _e('pte_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="pte_text" name="pte_text" type="text" style="width: 95%;word-break: break-word;" value="<?php echo htmlentities($item['pte_text']); ?>"
                    size="50"  placeholder="<?php _e('PTE', 'hcbp')?>" >
        </td>
    </tr>
    
         <tr class="form-field">
        <th valign="top" scope="row">
            <label for="ste"><?php _e('ste', 'hcbp')?></label>
        </th>
        <td>
            <input id="ste" name="ste" type="number" style="width: 95%" value="<?php echo esc_attr($item['ste'])?>"
                    size="50"  placeholder="<?php _e('ste', 'hcbp')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="ste_text"><?php _e('ste_text', 'hcbp')?></label>
        </th>
        <td>
            <input id="ste_text" name="ste_text" type="text" style="width: 95%;word-break: break-word;" value="<?php echo htmlentities($item['ste_text']); ?>" 
                    size="50"  placeholder="<?php _e('STE', 'hcbp')?>" > 
                            </td>
    </tr>
    
    </tbody>
</table>
<?php
}

/**
    * Simple function that validates data and retrieve bool on success
    * and error message(s) on error
    *
    * @param $item
    * @return bool|string
    */
function hcbp_validate_state($item)
{
    $messages = array();

    if (empty($item['stateID'])) $messages[] = __('State Abbreviation is required', 'hcbp');
        if (empty($item['stateDesc'])) $messages[] = __('State Name is required', 'hcbp');
  //  if (!ctype_digit($item['cbr'])) $messages[] = __('cbr Entry in wrong format', 'hcbp');
   //     if (!ctype_digit($item['mmcbr'])) $messages[] = __('mmcbr Entry in wrong format', 'hcbp');
    //            if (!ctype_digit($item['cbrr'])) $messages[] = __('cbrr Entry in wrong format', 'hcbp');
    //    if (!ctype_digit($item['chna'])) $messages[] = __('chna Entry in wrong format', 'hcbp');

    //    if (!ctype_digit($item['cbpis'])) $messages[] = __('cbpis Entry in wrong format', 'hcbp');
   //     if (!ctype_digit($item['fap'])) $messages[] = __('fap Entry in wrong format', 'hcbp');
   //             if (!ctype_digit($item['fapd'])) $messages[] = __('fapd Entry in wrong format', 'hcbp');

    //    if (!ctype_digit($item['lcbc'])) $messages[] = __('lcbc Entry in wrong format', 'hcbp');
   //             if (!ctype_digit($item['ite'])) $messages[] = __('ite Entry in wrong format', 'hcbp');

     //   if (!ctype_digit($item['pte'])) $messages[] = __('pte Entry in wrong format', 'hcbp');
      //          if (!ctype_digit($item['ste'])) $messages[] = __('ste Entry in wrong format', 'hcbp');




    //if(!empty($item['age']) && !absint(intval($item['age'])))  $messages[] = __('Age can not be less than zero');
    //if(!empty($item['age']) && !preg_match('/[0-9]+/', $item['age'])) $messages[] = __('Age must be number');
    //...

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}

/**
    * Do not forget about translating your plugin, use __('english string', 'your_uniq_plugin_name') to retrieve translated string
    * and _e('english string', 'your_uniq_plugin_name') to echo it
    * in this example plugin your_uniq_plugin_name == hcbp
    *
    * to create translation file, use poedit FileNew catalog...
    * Fill name of project, add "." to path (ENSURE that it was added - must be in list)
    * and on last tab add "__" and "_e"
    *
    * Name your file like this: [my_plugin]-[ru_RU].po
    *
    * http://codex.wordpress.org/Writing_a_Plugin#Internationalizing_Your_Plugin
    * http://codex.wordpress.org/I18n_for_WordPress_Developers
    */
function hcbp_languages()
{
    load_plugin_textdomain('hcbp', false, dirname(plugin_basename(__FILE__)));
}

add_action('init', 'hcbp_languages');