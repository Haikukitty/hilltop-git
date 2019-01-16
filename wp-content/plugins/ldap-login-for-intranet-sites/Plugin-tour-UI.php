<?php
function plugin_tour_ui() {
?>
    <div id="mo_ldap_settings" >
        <form name="f" method="post" id="show_ldap_pointers">
            <input type="hidden" name="option" value="clear_ldap_pointers"/>
            <input type="hidden" name="restart_tour" id="restart_tour"/>
            <input type="hidden" name="restart_plugin_tour" id="restart_plugin_tour"/>
        </form></div>
<br>
    <div style="font-size: large; font-weight: 600;">miniOrange LDAP/Active Directory Login for Intranet Sites
        <a id="license_upgrade" class=" add-new-h2 add-new-hover" style="position: relative;background-color: #e97d68 !important; border-color: orange; font-size: 16px; color: white;padding: 10px 18px; text-align: center;text-decoration: none;display: inline-block;" href="<?php echo add_query_arg( array( 'tab' => 'pricing' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">Licensing Plans</a>
        <span id="configure-restart-plugin-tour" style="position: relative;">
            <button id="restart_plugin_tour" type="button" value="restart_plugin_tour" style="position: relative" class="button button-primary button-large"  onclick="jQuery('#restart_plugin_tour').val('true');jQuery('#show_ldap_pointers').submit();"><i class="fa fa-refresh"></i>Restart Plugin Tour</button>
            </span></div>
    <style>
        .add-new-hover:hover{
            color: white !important;
        }

    </style>

    <div class="notice notice-info is-dismissible">
        <h4>If you are looking for Single-Sign-On in addition to authentication with AD/LDAP and do not have any Identity Provider Yet. You can try out <a href="https://idp.miniorange.com" target="_blank">miniOrange On-Premise IdP</a>.</h4>
    </div>
    <div class="mo2f_container">
            <h2 class="nav-tab-wrapper">
                <a id="ldap_default_tab_pointer" style="position: relative" class="nav-tab nav-tab-active" href="<?php echo add_query_arg( array('tab' => 'default'), $_SERVER['REQUEST_URI'] ); ?>">LDAP Configuration</a>
                <a id="ldap_role_mapping_tab_pointer" style="position: relative" class="nav-tab " href="<?php echo add_query_arg( array('tab' => 'rolemapping'), $_SERVER['REQUEST_URI'] ); ?>">Role Mapping</a>
                <a id="ldap_attribute_mapping_tab_pointer" style="position: relative" class="nav-tab" href="<?php echo add_query_arg( array('tab' => 'attributemapping'), $_SERVER['REQUEST_URI'] ); ?>">Attribute Mapping</a>
                <a id="ldap_config_settings_tab_pointer" style="position: relative" class="nav-tab" href="<?php echo add_query_arg( array('tab' => 'config_settings'), $_SERVER['REQUEST_URI'] ); ?>">Configuration Settings</a>
                <a id="ldap_troubleshooting_tab_pointer" style="position: relative" class="nav-tab" href="<?php echo add_query_arg( array('tab' => 'troubleshooting'), $_SERVER['REQUEST_URI'] ); ?>">Troubleshooting</a>
                <a id="ldap_feature_request_tab_pointer" style="position: relative" class="nav-tab" href="<?php echo add_query_arg( array('tab' => 'feature_request'), $_SERVER['REQUEST_URI'] ); ?>">Feature Request</a>
                <a id="ldap_account_setup_tab_pointer" style="position: relative" class="nav-tab" href="<?php echo add_query_arg( array('tab' => 'account'), $_SERVER['REQUEST_URI'] ); ?>">Account Setup</a>

            </h2>
            <table style="width:100%;">
                <tr>
                    <td style="width:65%;vertical-align:top;" id="configurationForm">
                        <div id="ldap_configuration_tab" style="display: block">
                            <?php echo mo_ldap_local_configuration_page(); ?>
                        </div>


                        <div id="troubleshooting_tab" style="display: none">
                            <?php echo mo_ldap_local_troubleshooting(); ?>
                        </div>


                        <div id="role_mapping_tab" style="display: none;">
                            <?php echo mo_ldap_local_rolemapping(); ?>
                        </div>


                        <div id="registration_tab" style="display: none">
                            <?php if (get_option ( 'mo_ldap_local_verify_customer' ) == 'true') {
                                echo mo_ldap_show_verify_password_page_ldap();
                            } else if (! Mo_Ldap_Local_Util::is_customer_registered()) {
                                echo mo_ldap_show_new_registration_page_ldap();
                            } else{
                                echo mo_ldap_show_customer_details();
                            }?>
                        </div>


                        <div id="attribute_mapping_tab" style="display: none">
                            <?php echo mo_ldap_show_attribute_mapping_page(); ?>
                        </div>


                        <div id="export_tab" style="display: none">
                            <?php echo mo_show_export_page(); ?>
                        </div>


                        <div id="user_management_tab" style="display:none;">
                            <?php echo mo_ldap_show_user_management_page(); ?>
                        </div>

                        <div id="feature_request_tab" style="display:none;">
                            <?php echo mo_ldap_local_support(); ?>
                        </div>

                    </td>

                        <td style="vertical-align:top;padding-left:1%;">
                            <?php echo mo_ldap_local_support(); ?>
                        </td>
                </tr>
            </table>
    </div>
    <div class='overlay_back' id="overlay" hidden></div>
<?php } ?>