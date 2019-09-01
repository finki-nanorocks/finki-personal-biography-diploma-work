<?php
	
	/**
	 *  With this class you can connect to repository ukim REST API to get xml data
	 *
	 * Class ApiConnectRepository
	 */
	class ApiConnectRepository
	{
		
		/**
		 * @var int
		 */
		public $status = 404;
		
		/**
		 * @var array
		 */
		public $item;
		
		/**
		 * ApiConnectRepository constructor.
		 * @param $teacher
		 */
		public function __construct($teacher)
		{
			$curl = curl_init();
			
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://repository.ukim.mk/rest/items/find-by-metadata-field",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => "<metadataentry>\n<key>dc.contributor.author</key>\n<language>en_US</language>\n<value>" . $teacher . "</value>\n</metadataentry>",
				CURLOPT_HTTPHEADER => array(
					"accept: application/xml",
					"cache-control: no-cache",
					"content-type: application/xml",
					"postman-token: af4fbce2-97e0-6934-5ff4-8199e0006c41"
				),
			));
			
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			
			
			if ($err) {
				
				$this->item = $err;
				$this->status = 404;
				
			} else {
				$xml = simplexml_load_string($response);
				$json = json_encode($xml);
				$array = json_decode($json, true);
				
				$this->item = $array["item"];
				if ($this->item !== null) {
					$this->status = 200;
				}
			}
		}
	}