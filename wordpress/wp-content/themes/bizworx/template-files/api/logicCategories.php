<?php
	// Get the class
	require_once('ApiConnectManager.php');
	
	function getApiJsonData($path, &$msg, &$data, $msg_end)
	{
		$ins = new ApiConnectManager($path);
		$msg = null;
		try {
			if (!$ins->canConnect() or $ins->getStatus() != 200) {
				$msg = "Нема податоци " . $msg_end;
			} else {
				$data = $ins->getData();
			}
		} catch (Exception $e) {
			$msg = "Нема податоци " . $msg_end;
		}
	}
	
	$path = ApiConnectManager::$url . '/api/categories';
	$messageCategory = null;
	$categories = null;
	
	// Show all categories
	getApiJsonData($path, $messageCategory, $categories, 'за категории.');
	
	// If category not set get first one
	$c = 1;
	if (isset($_GET["c"])) {
		$c = $_GET["c"];
	}
	
	$path = ApiConnectManager::$url . "/api/categories/" . $c . "/users";
	$messageUsers = null;
	$teachers = null;
	
	// Show teachers per category
	getApiJsonData($path, $messageUsers, $teachers, 'за избрана категорија на наставен кадар.');