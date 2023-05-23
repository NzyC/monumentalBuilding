<?php 
ini_set('display_errors', '1');
//display_error(E_ALL);

      //$to = $_POST["contactemail"];
        
        $to = $_POST["contactemail"];

	$subject = 'Contact Form';
	$errorMSG = "";
		
            if (!$_POST["name"]) {
                $errorMSG .= "Name is required";
            }elseif(namevalidation($_POST["name"])){
                $errorMSG .= namevalidation($_POST["name"]);
            }else {
                $name = $_POST["name"];
            }
         
                    
            /* Email */
            if (!$_POST["email"]) {
                $errorMSG .= "Email is required";
            }elseif(emailvalidation($_POST["email"])){
                $errorMSG .= emailvalidation($_POST["email"]);
            }else {
                $email = $_POST["email"];
            }   

           if ($_POST["phone"]) {                
               $phone= $_POST["phone"];                
            }else{
                   $phone='';
            }
            
            if ($_POST["suburb"]) {                
               $suburb= $_POST["suburb"];                
            }else{
                   $suburb='';
            }

            if (!$_POST["message"]) {
                $errorMSG .= "Description is required";
            }else {
                $message = $_POST["message"];
            }  
		
		$subject = $_POST["subject"];
				
		/* Message Field */

		if(empty($errorMSG)){
			
			$body = '';


                $body = 'Name : ' .$name.'<br />';
                $body .= 'Email : ' .$email.'<br />';				
                $body .= 'Phone : ' .$phone.'<br />';
                $body .= 'Suburb : ' .$suburb.'<br />';
                $body .= 'Message : ' .$message.'<br />';  
            

			//$body .= 'IP: : ' .$_SERVER['REMOTE_ADDR'].'<br />';
			//$body .= 'Useragent : ' . $_SERVER['HTTP_USER_AGENT'].'<br />';			
			$body .= 'Thanks';
			
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";// More headers
			$headers .= 'From: <noreply@sitelift.site>' . "\r\n";
			
			if(mail($to,$subject,$body,$headers)){

			    echo json_encode(['code'=>200, 'msg'=>'Mail has been sent.']);	
			}else{
			    echo json_encode(['code'=>200, 'msg'=>"Mail not send."]);
			}					
			//$msg = "check: success";
			//echo json_encode(['code'=>200, 'msg'=>$msg]);
			//header('Location: thank-you.html');
		die;
		}		
		echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

		die;
		//echo '<pre>';print_r($this->input->post());die;		
	
	
	// Name Validation
	function namevalidation($name){
		if (ctype_alpha(str_replace(' ', '', $name)) === false)  {
			return 'Name must contain letters and spaces only';
		}	
	}
	//Email Validation
	function emailvalidation($email){
		/*if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email)){*/
 	
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return 'Email Id not Valid';
		}
	}
	//Mobile number Validation
	function mobilevalidation($phone){
		if($phone!=htmlspecialchars($phone)){		
			return 'Mobile Number not Valid';
		}
	}
	// Html Tag not All in textarea
	function textareavalidation($text){
		if($text!=htmlspecialchars($text)){	
			return ' HTML tags not allows';
		}
	}

    
