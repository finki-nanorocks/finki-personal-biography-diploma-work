<?php
	// Get the api class
	require("ApiConnectManager.php");
	require("ApiConnectRepository.php");
	
	// Url for showing the img for teacher
	define('URL', ApiConnectManager::$url . '/uploads/');
	
	/**
	 * General function for making instances
	 *
	 * @param $path
	 * @param $msg
	 * @param $data
	 * @param $msg_end
	 */
	function getApiJsonData($path, &$msg, &$data, $msg_end)
	{
		$ins = new ApiConnectManager($path);
		$msg = null;
		try {
			if (!$ins->canConnect() or $ins->getStatus() != 200) {
				$msg = "Нема податоци" . $msg_end;
			} else {
				$data = $ins->getData();
			}
		} catch (Exception $e) {
			$msg = "Нема податоци" . $msg_end;
		}
	}
	
	/**
	 * Getting the data for teacher
	 */
	$path = ApiConnectManager::$url . "/api/users/" . $_GET["t"];
	$messageUser = null;
	$flag = false;
	$teacher = null;
	getApiJsonData($path, $messageUser, $teacher, ', контактираjте го администраторот или обидете се подоцна.');
	if (!is_null($teacher["user"]["idAssistant"])) {
		$flag = true;
	}
	
	/**
	 * Getting data for assistant
	 */
	$path = ApiConnectManager::$url . "/api/users/" . $teacher["user"]["idAssistant"];
	$messageUser = null;
	$assistant = null;
	getApiJsonData($path, $messageUser, $assistant, ', контактираjте го администраторот или обидете се подоцна.');
	
	/**
	 * Getting data for subjects
	 */
	$path = ApiConnectManager::$url . "/api/users/" . $_GET["t"] . "/subjects";
	$messageSubjects = null;
	$subjects = null;
	getApiJsonData($path, $messageSubjects, $subjects, ', контактираjте го администраторот или обидете се подоцна.');
	
	/**
	 * Return repository data
	 */
	$repo = new ApiConnectRepository($teacher["user"]["repoId"]);
	$repoData = $repo->item;
	$repoStatus = $repo->status;