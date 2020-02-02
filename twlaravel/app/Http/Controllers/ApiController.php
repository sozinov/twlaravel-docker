<?php 

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Http\Request;
use App\MyModel;
use Session;

class ApiController extends Controller
{
    public function index()
    {
     	return view('addDocument');
   	}

    public function uploadDocument(Request $request)
    {
    	if (!empty($request->input('submit')))
    	{
	        $file      		 = $request->file('file');
	        $filename  		 = $file->getClientOriginalName();
	        $extension 		 = $file->getClientOriginalExtension();
	        $tempPath  		 = $file->getRealPath();
	        $fileSize  		 = $file->getSize();
	        $mimeType        = $file->getMimeType();
	        $valid_extension = array("json");
	        // 2MB in Bytes
	        $maxFileSize = 2097152;
	        // Check file extension
	        if(in_array(strtolower($extension),$valid_extension))
	        {
	          // Check file size
	          if($fileSize <= $maxFileSize)
	          {
	          	$data_json = file_get_contents($file->getRealPath()); 
	          	$data      = json_decode($data_json, true);
    			$insert_data = array();

    			for ($i=0; $i < count($data); $i++) 
    			{
	    			$insert = MyModel::firstOrCreate(
				    		array( 'login' => $data[$i]['login']), 
				    		array(
				    			// 'first_name'  => $this->split_name($data[$i]['name'])[0],
				    			// 'last_name'   => $this->split_name($data[$i]['name'])[1],
				    			'name'   => $data[$i]['name'],
				    			'login'  => $data[$i]['login']
				    		)
		    		); 
		    		if($insert->wasRecentlyCreated)
		    			$insert_data[] = $insert;
    			}
	            Session::flash('message','Upload Successful. Data uploaded: '.json_encode($insert_data )  ) ;
	          }else{
	             Session::flash('message','File too large. File must be less than 2MB.');
	          }
	        }else{
	           Session::flash('message','Invalid File Extension.');
	        }
	    }
	    return redirect()->action('ApiController@index');
	}

    public function searcInDocument(Request $request)
    {
    	if (!empty($request->input('query')))
    	{
	    	$data   = MyModel::search($request->input('query'))->get()->toArray();
		 	$result = array(
		 		"query"       => $request->input('query'),
		 		"suggestions" => $this->toAutocompleteJSFormat($data)
	 		);
	 		return json_encode($result);
	 	}
    }

    private  function split_name($name) 
	{
	    $name = trim($name);
	    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
	    $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
	    return array($first_name, $last_name);
	}	

    public function toAutocompleteJSFormat($input_array)
    {
    	for ($i=0; $i < count($input_array); $i++) 
    	{ 
			foreach ($input_array[$i] as $key => $value) 
			{
				switch ($key) 
				{
					case 'name':
						$name = $value;

						// if (isset($input_array[$i]['last_name']))
						// 	$name .= ' '.$input_array[$i]['last_name'];

						$input_array[$i]['value'] = $name;
						unset($input_array[$i][$key]);
						// unset($input_array[$i]['last_name']);
						break;
					
					case 'login':
						$input_array[$i]['data'] = $value;
						unset($input_array[$i][$key]);
						break;
				}
			}
		}
		return $input_array;
    }
}