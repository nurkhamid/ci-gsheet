<?php

class Product extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function access($range)
	{
		// configure the Google Client
		$client = new \Google_Client();
		$client->setApplicationName('Google Sheets API');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');
		// credentials.json is the key file we downloaded while setting up our Google Sheets API
		$path = FCPATH . 'assets/json/credentials.json';
		$client->setAuthConfig($path);

		// configure the Sheets Service
		$service = new \Google_Service_Sheets($client);

		// the spreadsheet id can be found in the url
		$spreadsheetId = '1311TBXl0iUfBRCrjBfYISXvMUpcMbSfpVB38MnAedS8';
		$spreadsheet = $service->spreadsheets->get($spreadsheetId);

		$response = $service->spreadsheets_values->get($spreadsheetId, $range);
		$values = $response->getValues();
		return $values;
	}

	public function send_email($subject)
	{
		$this->load->config('email');
		$this->load->library('email');
		$this->email->from('tester@noreply', 'Nur Khamid');
		$this->email->to('khamid1196@gmail.com');

		$this->email->subject($subject);
		$this->email->message('This is email notification.');

		$this->email->set_mailtype('html');
		$this->email->send();
	}

	function index()
	{
		$this->load->view('v_product');
	}

	function data_product()
	{
		$range = 'Sheet1!A2:D'; // here we use the name of the Sheet to get all the rows
		$values = $this->access($range);
		echo json_encode($values);
	}

	function get_product()
	{
		$id_product = $this->input->get('id');
		$range = 'Sheet1!A' . $id_product . ':D' . $id_product; // get spesific row
		$values = $this->access($range);
		echo json_encode($values);
	}

	function store_product()
	{
		$subject = 'Store Product';
		$id_product = $this->input->post('id_product');
		$launch_date = $this->input->post('launch_date');
		$product_name = $this->input->post('product_name');
		$price = $this->input->post('price');

		// configure the Google Client
		$client = new \Google_Client();
		$client->setApplicationName('Google Sheets API');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');
		// credentials.json is the key file we downloaded while setting up our Google Sheets API
		$path = FCPATH . 'assets/json/credentials.json';
		$client->setAuthConfig($path);

		// configure the Sheets Service
		$service = new \Google_Service_Sheets($client);

		// the spreadsheet id can be found in the url
		$spreadsheetId = '1311TBXl0iUfBRCrjBfYISXvMUpcMbSfpVB38MnAedS8';
		$spreadsheet = $service->spreadsheets->get($spreadsheetId);

		$range = 'Sheet1';
		$values = [['30497', '20 Januari 2023', 'Keyboard', '1500000']]; //add the values to be appended
		//execute the request
		$body = new Google_Service_Sheets_ValueRange([
			'values' => $values
		]);
		$params = [
			'valueInputOption' => 'RAW'
		];
		$insert = [
			"insertDataOption" => "INSERT_ROWS"
		];
		$result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params, $insert);
		if ($result) {
			$this->send_email($subject);
		}
		echo json_encode($result);
	}

	function update_product()
	{
		$subject = 'Update Product';
		$id_product = $this->input->post('id_product');
		$launch_date = $this->input->post('launch_date');
		$product_name = $this->input->post('product_name');
		$price = $this->input->post('price');

		// configure the Google Client
		$client = new \Google_Client();
		$client->setApplicationName('Google Sheets API');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');
		// credentials.json is the key file we downloaded while setting up our Google Sheets API
		$path = FCPATH . 'assets/json/credentials.json';
		$client->setAuthConfig($path);

		// configure the Sheets Service
		$service = new \Google_Service_Sheets($client);

		// the spreadsheet id can be found in the url
		$spreadsheetId = '1311TBXl0iUfBRCrjBfYISXvMUpcMbSfpVB38MnAedS8';
		$spreadsheet = $service->spreadsheets->get($spreadsheetId);

		$range = 'Sheet1!A2:D2';
		$values = [['10398', '27 December 2022', 'SmartPhone', '30000']];

		$body = new Google_Service_Sheets_ValueRange([
			'values' => $values
		]);
		$params = [
			'valueInputOption' => 'RAW'
		];
		//executing the request
		$result = $service->spreadsheets_values->update(
			$spreadsheetId,
			$range,
			$body,
			$params
		);
		if ($result) {
			$this->send_email($subject);
		}
		echo json_encode($result);
	}

	function delete_product()
	{
		$subject = 'Delete Product';
		$id_product = $this->input->post('kode');
		// configure the Google Client
		$client = new \Google_Client();
		$client->setApplicationName('Google Sheets API');
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
		$client->setAccessType('offline');
		// credentials.json is the key file we downloaded while setting up our Google Sheets API
		$path = FCPATH . 'assets/json/credentials.json';
		$client->setAuthConfig($path);

		// configure the Sheets Service
		$service = new \Google_Service_Sheets($client);

		// the spreadsheet id can be found in the url
		$spreadsheetId = '1311TBXl0iUfBRCrjBfYISXvMUpcMbSfpVB38MnAedS8';
		$spreadsheet = $service->spreadsheets->get($spreadsheetId);

		$batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
			'requests' => array(
				'deleteDimension' => array(
					'range' => array(
						'sheetId' => 0, // the ID of the sheet/tab shown after 'gid=' in the URL
						'dimension' => "ROWS",
						'startIndex' => 3,
						'endIndex' => 3 + 1
					)
				)
			)
		));

		$result = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
		if ($result) {
			$this->send_email($subject);
		}
		echo json_encode($result);
	}
}
