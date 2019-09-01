<?php
	
	/**
	 * With this class you can connect to management system API to get json data
	 *
	 * Class ApiConnect
	 */
	class ApiConnectManager
	{
		
		/**
		 * @var string
		 */
		public $request;
		
		/**
		 * @var string
		 */
		public static $url = "http://diploma.work";
		
		/**
		 * ApiConnect constructor.
		 * @param $request
		 */
		public function __construct($request)
		{
			$this->request = $request;
		}
		
		/**
		 * Check connection
		 *
		 * @return bool
		 */
		public function canConnect()
		{
			if (is_wp_error($this->request)) {
				return false;
			}
			return true;
		}

		/**
		 * Parse json to array
		 *
		 * @return array|bool|mixed|object
		 */
		protected function getBody()
		{
			$body = file_get_contents($this->request);
			if ($body === false) {
				return false;
			}
			
			$data = json_decode($body, true);
			return $data;
		}
		
		/**
		 * Return status
		 *
		 * @return int|mixed
		 */
		public function getStatus()
		{
			$body = $this->getBody();
			if (!$body) {
				return 404;
			}
			return $body["status"];
		}
		
		/**
		 * Return data
		 *
		 * @return mixed|string
		 */
		public function getData()
		{
			$body = $this->getBody();
			if (!$body) {
				return "Нема податоци.";
			}
			return $body["data"];
		}
	}
	