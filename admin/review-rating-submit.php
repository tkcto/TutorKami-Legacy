<?PHP

require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


date_default_timezone_set("Asia/Kuala_Lumpur");
$create_date = date('d/m/Y');


//if( $_POST['tutorID'] != '' && $_POST['sessionIDLogin'] != '' && $_POST['ratingName'] != '' && $_POST['ratingName2'] != '' && $_POST['ratingComments'] != '' ) {
if( $_POST['tutorID'] != '' && $_POST['sessionIDLogin'] != '' && $_POST['ratingName'] != '' && $_POST['ratingName2'] != '' && isset($_POST['ratingComments']) ) {
    if( $_POST['sessionIDLogin'] == '2' ){
        $userdInitial = '-C1';
    }else if( $_POST['sessionIDLogin'] == '3' ){
        $userdInitial = '-FM';
    }else if( $_POST['sessionIDLogin'] == '4' ){
        $userdInitial = '-C2';
    }else if( $_POST['sessionIDLogin'] == '5' ){
        $userdInitial = '-C3';
    }else if( $_POST['sessionIDLogin'] == '6' ){
        $userdInitial = '-MM';
    }else if( $_POST['sessionIDLogin'] == '1581040' ){
        $userdInitial = '-MM';
    }else if( $_POST['sessionIDLogin'] == '8' ){
        $userdInitial = '-CTO';
    }else if( $_POST['sessionIDLogin'] == '1579926' ){
        $userdInitial = '-AHN';
    }else{
        $userdInitial = '-NOT SET';
    }
    
    if( $_POST['ratingName2'] == 'false' ){
        $untick = 'untick';
    }else{
        $untick = 'tick';
    }
    $comments = $create_date.' '.$userdInitial.' '.$_POST['ratingComments'].' ('.$untick.' '.$_POST['ratingName'].')';

    if( $_POST['ratingName'] == "1" ){
                $queryListTK = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
                $resultListTK = $conn->query($queryListTK); 
                if($resultListTK->num_rows > 0){
                    $rowListTK = $resultListTK->fetch_assoc();
                    
                        $newNote = $comments.'\n'.$rowListTK["ri_comments"];
                        
                        $sql = "UPDATE tk_review_rating_internal SET ri_jobs='".$_POST['ratingName2']."2', ri_comments='".$newNote."' WHERE ri_id='".$rowListTK['ri_id']."' ";
                    	if ($conn->query($sql) === TRUE) {
                    	    echo 'success';
                    	}else{
                    	    echo 'x success';
                    	}
                    
                    
                }else{
                     $sql = "INSERT INTO tk_review_rating_internal (ri_tutor, ri_jobs, ri_experience, ri_signed, ri_location, ri_session, ri_postponed, ri_replied, ri_cycles, ri_comments) VALUES
                     ('".$_POST['tutorID']."', '".$_POST['ratingName2']."2', '', '', '', '', '', '', '', '".$comments."')";
                		    
                	if ($conn->query($sql) === TRUE) {
                	    echo 'success';
                	}else{
                	    echo 'x success';
                	}
                }
    }

    else if( $_POST['ratingName'] == "2" ){
                $queryListTK = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
                $resultListTK = $conn->query($queryListTK); 
                if($resultListTK->num_rows > 0){
                    $rowListTK = $resultListTK->fetch_assoc();
                    
                        $newNote = $comments.'\n'.$rowListTK["ri_comments"];
           
                        $sql = "UPDATE tk_review_rating_internal SET ri_experience='".$_POST['ratingName2']."2', ri_comments='".$newNote."' WHERE ri_id='".$rowListTK['ri_id']."' ";
                    	if ($conn->query($sql) === TRUE) {
                    	    echo 'success';
                    	}else{
                    	    echo 'x success';
                    	}
                    
                    
                }else{
                     $sql = "INSERT INTO tk_review_rating_internal (ri_tutor, ri_jobs, ri_experience, ri_signed, ri_location, ri_session, ri_postponed, ri_replied, ri_cycles, ri_comments) VALUES
                     ('".$_POST['tutorID']."', '', '".$_POST['ratingName2']."2', '', '', '', '', '', '', '".$comments."')";
                		    
                	if ($conn->query($sql) === TRUE) {
                	    echo 'success';
                	}else{
                	    echo 'x success';
                	}
                }
    }else if( $_POST['ratingName'] == "3" ){
                $queryListTK = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
                $resultListTK = $conn->query($queryListTK); 
                if($resultListTK->num_rows > 0){
                    $rowListTK = $resultListTK->fetch_assoc();
                    
                        $newNote = $comments.'\n'.$rowListTK["ri_comments"];
           
                        $sql = "UPDATE tk_review_rating_internal SET ri_signed='".$_POST['ratingName2']."2', ri_comments='".$newNote."' WHERE ri_id='".$rowListTK['ri_id']."' ";
                    	if ($conn->query($sql) === TRUE) {
                    	    echo 'success';
                    	}else{
                    	    echo 'x success';
                    	}
                    
                    
                }else{
                     $sql = "INSERT INTO tk_review_rating_internal (ri_tutor, ri_jobs, ri_experience, ri_signed, ri_location, ri_session, ri_postponed, ri_replied, ri_cycles, ri_comments) VALUES
                     ('".$_POST['tutorID']."', '', '', '".$_POST['ratingName2']."2', '', '', '', '', '', '".$comments."')";
                		    
                	if ($conn->query($sql) === TRUE) {
                	    echo 'success';
                	}else{
                	    echo 'x success';
                	}
                }
    }else if( $_POST['ratingName'] == "4" ){
                $queryListTK = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
                $resultListTK = $conn->query($queryListTK); 
                if($resultListTK->num_rows > 0){
                    $rowListTK = $resultListTK->fetch_assoc();
                    
                        $newNote = $comments.'\n'.$rowListTK["ri_comments"];
           
                        $sql = "UPDATE tk_review_rating_internal SET ri_location='".$_POST['ratingName2']."2', ri_comments='".$newNote."' WHERE ri_id='".$rowListTK['ri_id']."' ";
                    	if ($conn->query($sql) === TRUE) {
                    	    echo 'success';
                    	}else{
                    	    echo 'x success';
                    	}
                    
                    
                }else{
                     $sql = "INSERT INTO tk_review_rating_internal (ri_tutor, ri_jobs, ri_experience, ri_signed, ri_location, ri_session, ri_postponed, ri_replied, ri_cycles, ri_comments) VALUES
                     ('".$_POST['tutorID']."', '', '', '', '".$_POST['ratingName2']."2', '', '', '', '', '".$comments."')";
                		    
                	if ($conn->query($sql) === TRUE) {
                	    echo 'success';
                	}else{
                	    echo 'x success';
                	}
                }
    }else if( $_POST['ratingName'] == "5" ){
                $queryListTK = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
                $resultListTK = $conn->query($queryListTK); 
                if($resultListTK->num_rows > 0){
                    $rowListTK = $resultListTK->fetch_assoc();
                    
                        $newNote = $comments.'\n'.$rowListTK["ri_comments"];
           
                        $sql = "UPDATE tk_review_rating_internal SET ri_session='".$_POST['ratingName2']."2', ri_comments='".$newNote."' WHERE ri_id='".$rowListTK['ri_id']."' ";
                    	if ($conn->query($sql) === TRUE) {
                    	    echo 'success';
                    	}else{
                    	    echo 'x success';
                    	}
                    
                    
                }else{
                     $sql = "INSERT INTO tk_review_rating_internal (ri_tutor, ri_jobs, ri_experience, ri_signed, ri_location, ri_session, ri_postponed, ri_replied, ri_cycles, ri_comments) VALUES
                     ('".$_POST['tutorID']."', '', '', '', '', '".$_POST['ratingName2']."2', '', '', '', '".$comments."')";
                		    
                	if ($conn->query($sql) === TRUE) {
                	    echo 'success';
                	}else{
                	    echo 'x success';
                	}
                }
    }else if( $_POST['ratingName'] == "6" ){
                $queryListTK = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
                $resultListTK = $conn->query($queryListTK); 
                if($resultListTK->num_rows > 0){
                    $rowListTK = $resultListTK->fetch_assoc();
                    
                        $newNote = $comments.'\n'.$rowListTK["ri_comments"];
           
                        $sql = "UPDATE tk_review_rating_internal SET ri_postponed='".$_POST['ratingName2']."2', ri_comments='".$newNote."' WHERE ri_id='".$rowListTK['ri_id']."' ";
                    	if ($conn->query($sql) === TRUE) {
                    	    echo 'success';
                    	}else{
                    	    echo 'x success';
                    	}
                    
                    
                }else{
                     $sql = "INSERT INTO tk_review_rating_internal (ri_tutor, ri_jobs, ri_experience, ri_signed, ri_location, ri_session, ri_postponed, ri_replied, ri_cycles, ri_comments) VALUES
                     ('".$_POST['tutorID']."', '', '', '', '', '', '".$_POST['ratingName2']."2', '', '', '".$comments."')";
                		    
                	if ($conn->query($sql) === TRUE) {
                	    echo 'success';
                	}else{
                	    echo 'x success';
                	}
                }
    }else if( $_POST['ratingName'] == "7" ){
                $queryListTK = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
                $resultListTK = $conn->query($queryListTK); 
                if($resultListTK->num_rows > 0){
                    $rowListTK = $resultListTK->fetch_assoc();
                    
                        $newNote = $comments.'\n'.$rowListTK["ri_comments"];
           
                        $sql = "UPDATE tk_review_rating_internal SET ri_replied='".$_POST['ratingName2']."2', ri_comments='".$newNote."' WHERE ri_id='".$rowListTK['ri_id']."' ";
                    	if ($conn->query($sql) === TRUE) {
                    	    echo 'success';
                    	}else{
                    	    echo 'x success';
                    	}
                    
                    
                }else{
                     $sql = "INSERT INTO tk_review_rating_internal (ri_tutor, ri_jobs, ri_experience, ri_signed, ri_location, ri_session, ri_postponed, ri_replied, ri_cycles, ri_comments) VALUES
                     ('".$_POST['tutorID']."', '', '', '', '', '', '', '".$_POST['ratingName2']."2', '', '".$comments."')";
                		    
                	if ($conn->query($sql) === TRUE) {
                	    echo 'success';
                	}else{
                	    echo 'x success';
                	}
                }
    }else if( $_POST['ratingName'] == "8" ){
                $queryListTK = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
                $resultListTK = $conn->query($queryListTK); 
                if($resultListTK->num_rows > 0){
                    $rowListTK = $resultListTK->fetch_assoc();
                    
                        $newNote = $comments.'\n'.$rowListTK["ri_comments"];
           
                        $sql = "UPDATE tk_review_rating_internal SET ri_cycles='".$_POST['ratingName2']."2', ri_comments='".$newNote."' WHERE ri_id='".$rowListTK['ri_id']."' ";
                    	if ($conn->query($sql) === TRUE) {
                    	    echo 'success';
                    	}else{
                    	    echo 'x success';
                    	}
                    
                    
                }else{
                     $sql = "INSERT INTO tk_review_rating_internal (ri_tutor, ri_jobs, ri_experience, ri_signed, ri_location, ri_session, ri_postponed, ri_replied, ri_cycles, ri_comments) VALUES
                     ('".$_POST['tutorID']."', '', '', '', '', '', '', '', '".$_POST['ratingName2']."2', '".$comments."')";
                		    
                	if ($conn->query($sql) === TRUE) {
                	    echo 'success';
                	}else{
                	    echo 'x success';
                	}
                }
    }






}else{
    echo 'Error : 2';
}
?>