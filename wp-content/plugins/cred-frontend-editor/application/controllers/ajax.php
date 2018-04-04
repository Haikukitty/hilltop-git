<?php

/**
 * Main Class responsible to set CRED Ajax handlers
 *
 * @since 1.9.4
 */
class CRED_Ajax {

	public function initialize() {
		$cred_ajax_media_upload_fix = new CRED_Ajax_Media_Upload_Fix();
		$cred_ajax_media_upload_fix->initialize();
		$cred_ajax_init = new CRED_Form_Ajax_Init();
		$cred_ajax_init->initialize();
	}
}