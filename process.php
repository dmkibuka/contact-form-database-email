<?php
require_once("Database.php");

if($_SERVER["REQUEST_METHOD"] == "POST"):

	//Handle some basic validation
    $errors = array();
    
    //Validate that we HAVE an email to send to, it isn't empty, and matches regex for email
    if(!isset($_POST['email']) || empty($_POST['email']) || !filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)):
        $errors[] = 'Please enter a valid email address';
    endif;
    
    //Validate that we have a first name
    if(!isset($_POST['firstname']) || empty($_POST['firstname'])):
        $errors[] = 'Please enter your First name';
    endif;

    //Validate that we have a last name
    if(!isset($_POST['lastname']) || empty($_POST['lastname'])):
        $errors[] = 'Please enter your Last name';
    endif;

    //Validate that we have a phone number
    if(!isset($_POST['phone']) || empty($_POST['phone'])):
        $errors[] = 'Please enter your Phone number';
    endif;

    //And validate that we actually have a message
    if(!isset($_POST['message']) || empty($_POST['message'])):
        $errors[] = 'A message is required to send anything';
    endif;
    //End basic validation
    
    //If no errors, process form
    if(empty( $errors)):

		//Establish database connection with server..
		$db = new Form_Database;

		//Fetching form inputs
		$firstname = $db->escape_value(trim($_POST['firstname'])); //reqiured
		$lastname = $db->escape_value(trim($_POST['lastname'])); //reqiured
		$email = $db->escape_value(trim($_POST['email'])); //reqiured
		$phone = $db->escape_value(trim($_POST['phone'])); //reqiured
		$message = $db->escape_value(trim($_POST['message'])); //not reqiured
		if(isset($_POST['add_maillist']) && $_POST['add_maillist'] == 'Yes'): 
			$add_maillist = $db->escape_value(intval(1));
		else:
			$add_maillist = $db->escape_value(intval(0));
		endif; //not reqiured

		//Insert CUSTOMER into CUSTOMER TABLE
		$sql = "INSERT IGNORE INTO customer (customer_first_name, customer_last_name, customer_email, customer_phone) VALUES ('$firstname', '$lastname', '$email', '$phone')";
		$db->query($sql);

		//Get last inserted id
		$customer_id = $db->insert_id(); 

		if(!$customer_id): //Duplicate customer was detected
			//select CUSTOMER ID from CUSTOMER TABLE
			$sql = "SELECT customer_id FROM customer WHERE customer_email = '$email'";
			$result_set = $db->query($sql);
			$row = $db->fetch_array($result_set);
			$customer_id = $row['customer_id'];
		endif;

		//Insert EMAIL into MAILLIST TABLE
		if($add_maillist == 1):
			$sql = "INSERT IGNORE INTO maillist (maillist_email, customer_customer_id) VALUES ('$email','$customer_id')";
			$db->query($sql);
		endif;
        
        // Create the email and send the message
		$to = " "; // Add your email address inbetween the " " replacing yourname@yourdomain.com - This is where the form will send a message to.
		$email_subject = "Website Contact Form:  {$firstname} {$lastname}";
		$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nFirst name: $firstname\n\nLast name: $lastname\n\nEmail Address: $email\n\nPhone: $phone\n\nMessage: $message";
		$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Reply-To: $email";   
		mail($to,$email_subject,$email_body,$headers);	

		if($db->affected_rows()):
             //Success message
		 	echo "Request successfully submitted <br />";
		 	echo "Thank you {$firstname} {$lastname}";
		 	//Close database connection
		  	$db->close_connection();
		else:
            //Error message/ fail message
		 	echo "Sorry!! Unabe To Submit <br />";
		 	echo "Plesae contact us directly <a href=\"mailto:myemail@email.com\">myemail@email.com</a>";
		 	//Close database connection
		  	$db->close_connection();
		endif;
	else:
        //Validation ERROR message
		echo "<div class='alert alert-danger'>";
		echo "<strong>The following fields are missing:</strong><br />";
		foreach ($errors as $e) {
			 echo $e .'<br />';
		}
		echo "</div>";
	endif;
else:
	return false;
endif;
?>