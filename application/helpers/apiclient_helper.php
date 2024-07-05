<?php  
/**
 * Function Name
 *
 * Function Description
 *
 * @access	public
 * @param	type	name
 * @return	type	
 */
 
if (! function_exists('api_client'))
{
	function api_client($url)
	{
		 $api_url = $url;
		 $json_data = file_get_contents($api_url);
	 	return json_decode($json_data, TRUE);
	}
}
if (! function_exists('file_get_contents_curl'))
{

	function file_get_contents_curl( $url ) {

	  $ch = curl_init();

	  curl_setopt( $ch, CURLOPT_AUTOREFERER, TRUE );
	  curl_setopt( $ch, CURLOPT_HEADER, 0 );
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	  curl_setopt( $ch, CURLOPT_URL, $url );
	  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, TRUE );

	  $data = curl_exec( $ch );
	  curl_close( $ch );

	  return $data;

	}
}

if (! function_exists('api_curl'))
{
	function api_curl($url, $arr)
	{
		 // set post fields
		$post = $arr;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		// do anything you want with your response
		return $response;
		 
	}
}
if (! function_exists('postApi'))
{
 	function postApi($url, $arr)
	{
		 
		// set post fields
		$post = $arr;
		// set headers
		$request_headers = [
            'Authorization: Basic QmFsYW5nYW5rYWI6Ymtwc2RtQDIwMjI=',
			'apiKey:bkpsdm6811',
			'Content-Type:multipart/form-data',
			'Accept:application/json'
		];
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		// do anything you want with your response
		return $response;
		 
	}
}

if (! function_exists('api_curl_get'))
{
	function api_curl_get($url='')
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		if($response === false) {
			$response = '-';
		}
		// do anything you want with your response
		return $response;
		 
	}
}

if (! function_exists('Upload'))
{
	function Upload($url, $arr)
	{

		// set post fields
		$post = $arr;

		$request_headers = [
            'Authorization: Basic QmFsYW5nYW5rYWI6Ymtwc2RtQDIwMjI=',
			'apiKey:bkpsdm6811',
			'Content-Type:multipart/form-data',
			'Accept:application/json'
		];
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);	
		return $result;
		 
	}
}

if (!function_exists('httpclient')) {
    function httpclient($params = [], $debug = false)
    {
        // Pastikan parameter URL terisi
        if (! isset($params['url'])) {
            return false;
        }

        // Dapatkan HTTP method yang dipakai
        $method = isset($params['method']) ? strtoupper($params['method']) : 'GET';

        // Siapkan request headers
        $headers = [
            'Cache-Control' => 'no-cache',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json; charset=utf-8',
        ];
        if (isset($params['headers']) && is_array($params['headers'])) {
            $headers = array_merge($headers, $params['headers']);
        }

        // Hapus header Content-Type untuk request dengan method GET
        // if ($method === 'GET') {
        // 	unset($headers['Content-Type']);
        // }

        // Opsi default
        $options = [
            CURLOPT_URL => $params['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => true,
            CURLOPT_ENCODING => 'utf-8',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ];

        // Siapkan URL dengan query string
        if (isset($params['url_params']) && is_array($params['url_params'])) {
            $options[CURLOPT_URL] = $params['url'].'?'.http_build_query($params['url_params']);
        }

        // Siapkan payload untuk method selain GET/HEAD
        // sesuai tipe data yang dipakai
        if (isset($params['payload']) && is_array($params['payload'])) {
            // Jika tipe data yang dipakai berupa JSON, gunakan json_encode
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                $options[CURLOPT_POSTFIELDS] = json_encode($params['payload']);
            }

            // Jika tipe data yang dipakai berupa form URL encoded, gunakan http_build_query
            if (stripos($headers['Content-Type'], 'application/x-www-form-urlencoded') !== false) {
                $options[CURLOPT_POSTFIELDS] = http_build_query($params['payload']);
            }
        }

        // Tambahkan header ke opsi
        foreach ($headers as $headerKey => $headerValue) {
            $headers[$headerKey] = $headerKey.':'.$headerValue;
        }
        $options[CURLOPT_HTTPHEADER] = array_values($headers);

        // Eksekusi
        $handle = curl_init();
        curl_setopt_array($handle, $options);

        $response = curl_exec($handle);
        $errno = curl_errno($handle);
        $errmsg = curl_error($handle);
        $info = curl_getinfo($handle);

        curl_close($handle);

        // Ambil response header dan format ulang untuk mendapatkan kode status HTTP
        $rawheaders = preg_split('/\r\n|\r|\n/', trim(substr($response, 0, $info['header_size'])));
        preg_match('/^(HTTP\/[\d\.]+) (\d{3}) (.+?)$/', array_shift($rawheaders), $httpstatus);

        // Ambil response body
        $body = substr($response, $info['header_size']);
        // Jika parameter 'decode_body' di-set ke 'true', dekode body dari JSON.
        // Jika dekode berhasil, gunakan hasil dekode sebagai body
        if (isset($params['decode_body']) && $params['decode_body']) {
            $decoded = json_decode($body, true);
            if (! is_null($decoded)) {
                $body = $decoded;
            }
        }

        // Siapkan output
        $return = [
            'isError' => (int) $errno > 0 || (int) $httpstatus[2] >= 400,
            'isErrorRequest' => (int) $errno > 0,
            'isErrorResponse' => count($httpstatus) && (int) $httpstatus[2] >= 400,
            'error' => [
                'code' => (int) $errno,
                'strcode' => $errno ? curl_strerrcode($errno) : null,
                'message' => $errno ? $errmsg : null,
            ],
            'status' => [
                'code' => count($httpstatus) ? (int) $httpstatus[2] : 0,
                'message' => count($httpstatus) ? $httpstatus[3] : null,
                'protocol' => count($httpstatus) ? $httpstatus[1] : null,
            ],
            'headers' => $rawheaders,
            'body' => $body,
        ];

        // Jika debug aktif, tambahkan debug di bawah.
        if ($debug) {
            $return['request_debug'] = [
                'url' => $options[CURLOPT_URL],
                'method' => $options[CURLOPT_CUSTOMREQUEST],
                'headers' => $options[CURLOPT_HTTPHEADER],
            ];
            if (isset($params['payload'])) {
                $return['payload'] = [
                    'input' => $params['payload'],
                    'formatted' => $options[CURLOPT_POSTFIELDS],
                ];
            }
        }

        // Selesai.
		header("Content-Type: application/json");
        return $return;
    }
}
?>