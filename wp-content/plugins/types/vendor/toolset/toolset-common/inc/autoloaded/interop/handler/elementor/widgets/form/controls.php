<?php

namespace OTGS\Toolset\Common\Interop\Handler\Elementor;

/**
 * Class that handles the Toolset Form Elementor widget controls registration.
 *
 * @since 3.0.7
 */
class FormWidgetControls extends ToolsetElementorWidgetControlsBase {
	const RESOURCE_TO_EDIT_CONTROL_KEY = 'resource_to_edit';

	/**
	 * Registers the controls for the Toolset View Elementor widget.
	 */
	public function register_controls() {
		$this->register_form_controls_section();
	}

	/**
	 * Registers the controls for the Form selection section of the Toolset View Elementor widget and the Form customization.
	 */
	public function register_form_controls_section() {
		$this->widget->start_controls_section(
			'form_selection_section',
			array(
				'label' => __( 'Form selection', 'wp-cred' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->widget->add_control(
			'form',
			array(
				'label' => __( 'Form', 'wp-cred' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'groups' => $this->create_form_select_control_options(),
				'default' => '0',
				'description' => __( 'Select a Form to render its preview inside the editor.', 'wp-cred' ),
			)
		);

		$this->register_post_to_edit_controls();

		$this->register_user_to_edit_controls();

		$this->register_form_edit_controls();

		$this->widget->add_control(
			self::RESOURCE_TO_EDIT_CONTROL_KEY,
			array(
				'label' => __( 'Has custom search', 'wp-cred' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => '',
			)
		);

		$this->widget->end_controls_section();
	}

	/**
	 * Registers the controls needed for the customization of the "Post edit" forms.
	 */
	public function register_post_to_edit_controls() {
		$form_for_edit_posts_selected_condition = array(
			'form!' => '0',
			self::RESOURCE_TO_EDIT_CONTROL_KEY => 'post',
		);

		$this->widget->add_control(
			'post_to_edit',
			array(
				'label' => __( 'Post to edit', 'wp-cred' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'current_post' => __( 'The current post', 'wp-cred' ),
					'another_post' => __( 'Another post', 'wp-cred' ),
				),
				'default' => 'current_post',
				'condition' => $form_for_edit_posts_selected_condition,
			)
		);

		if ( $this->is_elementor_pro_active->is_met() ) {
			$this->widget->add_control(
				'another_post_select_control',
				array(
					'label' => __( 'Post', 'wp-cred' ),
					'label_block' => true,
					'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
					'default' => '',
					'options' => array(),
					'filter_type' => 'post',
					'condition' => array_merge(
						$form_for_edit_posts_selected_condition,
						array(
							'post_to_edit' => 'another_post',
						)
					),
				)
			);
		} else {
			$this->widget->add_control(
				'another_post_select_control',
				array(
					'label' => __( 'Post', 'wp-cred' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => array_merge(
						$form_for_edit_posts_selected_condition,
						array(
							'post_to_edit' => 'another_post',
						)
					),
				)
			);

			$template_repository = \Toolset_Output_Template_Repository::get_instance();
			$upgrade_to_pro_for_select2 = $this->toolset_renderer->render(
				$template_repository->get( $this->constants->constant( '\Toolset_Output_Template_Repository::PAGE_BUILDER_MODULES_ELEMENTOR_UPGRADE_TO_PRO_FOR_SELECT2' ) ),
				array(
					'message' => __( 'You can have a Select2 control that supports searching among the available posts, instead of writing the post/page ID on your own.', 'wp-cred' )
				),
				false
			);
			$this->widget->add_control(
				'post_upgrade_to_pro_for_select2',
				array(
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => $upgrade_to_pro_for_select2,
					'condition' => array_merge(
						$form_for_edit_posts_selected_condition,
						array(
							'post_to_edit' => 'another_post',
						)
					),
				)
			);
		}
	}

	/**
	 * Registers the controls needed for the customization of the "User edit" forms.
	 */
	public function register_user_to_edit_controls() {
		$form_for_edit_users_selected_condition = array(
			'form!' => '0',
			self::RESOURCE_TO_EDIT_CONTROL_KEY => 'user',
		);

		$this->widget->add_control(
			'user_to_edit',
			array(
				'label' => __( 'User to edit', 'wp-cred' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'current_user' => __( 'The current user', 'wp-cred' ),
					'another_user' => __( 'Another user', 'wp-cred' ),
				),
				'default' => 'current_user',
				'condition' => $form_for_edit_users_selected_condition,
			)
		);

//		if ( $this->is_elementor_pro_active->is_met() ) {
//			$this->widget->add_control(
//				'another_user_select_control',
//				array(
//					'label' => __( 'User', 'wp-cred' ),
//					'label_block' => true,
//					'type' => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
//					'default' => '',
//					'options' => [],
//					'filter_type' => 'user',
//					'condition' => array_merge(
//						$form_for_edit_users_selected_condition,
//						array(
//							'user_to_edit' => 'another_user',
//						)
//					),
//				)
//			);
//		} else {
			$this->widget->add_control(
				'another_user_select_control',
				array(
					'label' => __( 'User', 'wp-cred' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'condition' => array_merge(
						$form_for_edit_users_selected_condition,
						array(
							'user_to_edit' => 'another_user',
						)
					),
				)
			);

//			$template_repository = \Toolset_Output_Template_Repository::get_instance();
//			$upgrade_to_pro_for_select2 = $this->toolset_renderer->render(
//				$template_repository->get( $this->constants->constant( 'Toolset_Output_Template_Repository::PAGE_BUILDER_MODULES_ELEMENTOR_UPGRADE_TO_PRO_FOR_SELECT2' ) ),
//				array(
//					'message' => __( 'You can have a Select2 control that supports searching among the available users, instead of writing the user ID on your own.', 'wp-cred' )
//				),
//				false
//			);
//			$this->widget->add_control(
//				'user_upgrade_to_pro_for_select2',
//				[
//					'type' => \Elementor\Controls_Manager::RAW_HTML,
//					'raw' => $upgrade_to_pro_for_select2,
//					'condition' => array_merge(
//						$form_for_edit_users_selected_condition,
//						array(
//							'user_to_edit' => 'another_user',
//						)
//					),
//				]
//			);
//		}
	}

	/**
	 * Registers the button that redirects to the Form edit page.
	 */
	public function register_form_edit_controls() {
		$form_selected_condition = array(
			'form!' => '0',
		);

		$this->widget->add_control(
			'hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
				'condition' => $form_selected_condition,
			)
		);

		$this->widget->add_control(
			'edit_form_btn',
			array(
				'label' => __( 'Edit selected Form in Toolset', 'wp-cred' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'default',
				'button_type' => 'default',
				'text' => __( 'Edit Form', 'wp-cred' ),
				'event' => 'toolset:pageBuilderWidgets:elementor:editor:editForm',
				'description' => __( 'Use this button to edit the Form in the Toolset Forms editor.', 'wp-cred' ),
				'condition' => $form_selected_condition,
			)
		);
	}

	/**
	 * Returns the options for the Form selection control of the Toolset Form Elementor widget. Basically it forms the
	 * list of the available Forms accordingly to shape the options of the control.
	 *
	 * @return array
	 *
	 * Example output:
	 *
	 * array (
	 *     0 => 'Select a Form',
	 *     'post_new' => array (
	 *             'label' => 'Add Post forms',
	 *             'options' => array (
	 *                 101 => 'New post form 1',
	 *             ),
	 *     ),
	 *     'post_edit' => array (
	 *             'label' => 'Edit Post forms',
	 *             'options' => array (
	 *                 102 => 'Edit post form 2',
	 *             ),
	 *     ),
	 *     'user_new' => array (
	 *             'label' => 'Add User forms',
	 *             'options' => array (
	 *                 103 => 'New user form 3',
	 *             ),
	 *     ),
	 *     'user_edit' => array (
	 *             'label' => 'Edit User forms',
	 *             'options' => array (
	 *                 104 => 'Edit user form 4',
	 *             ),
	 *     ),
	 * )
	 */
	public function create_form_select_control_options() {
		$form_select_control_options = array();

		$published_forms['post'] = apply_filters( 'cred_get_available_forms', array(), $this->constants->constant( '\CRED_Form_Domain::POSTS' ) );
		$published_forms['user'] = apply_filters( 'cred_get_available_forms', array(), $this->constants->constant( '\CRED_Form_Domain::USERS' ) );

		$form_types = array(
			'post',
			'user',
		);

		$form_actions = array(
			'new',
			'edit',
		);

		foreach ( $form_types as $form_type ) {
			foreach ( $form_actions as $form_action ) {
				if (
					isset( $published_forms[ $form_type ][ $form_action ] ) &&
					count( $published_forms[ $form_type ][ $form_action ] ) > 0
				) {
					$group = array(
						'label'   => '',
						'options' => array(),
					);
					foreach ( $published_forms[ $form_type ][ $form_action ] as $form ) {
						if ( 'post' === $form_type && 'new' === $form_action ) {
							$group['label'] = __( 'Add Post forms', 'wp-cred' );
						} elseif (
							'post' === $form_type &&
							'edit' === $form_action
						) {
							$group['label'] = __( 'Edit Post forms', 'wp-cred' );
						} elseif (
							'user' === $form_type &&
							'new' === $form_action
						) {
							$group['label'] = __( 'Add User forms', 'wp-cred' );
						} elseif (
							'user' === $form_type &&
							'edit' === $form_action
						) {
							$group['label'] = __( 'Edit User forms', 'wp-cred' );
						}
						$group['options'][ $form->ID ] = $form->post_title;
					}
					$form_select_control_options[ $form_type . '_' . $form_action ] = $group;
				}
			}
		}

		if ( count( $form_select_control_options ) > 0 ) {
			array_unshift( $form_select_control_options, __( 'Select a Form', 'wp-cred' ) );
		} else {
			$form_select_control_options[] = __( 'Create a Form first', 'wp-cred' );
		}

		return $form_select_control_options;
	}
}