<?php

include("database.php");

    

if(isset($_POST['action']) or isset($_GET['view'])) //show all events

{

    if(isset($_GET['view']))

    {

         $sql = "SELECT id, work_type_id, start_date, end_date, city_id FROM work_plans ";

		$req = $bdd->prepare($sql);
		$req->execute();

		$events_result = $req->fetchAll();

        

        foreach($events_result as $event)
        {
			$start = explode(" ", $event['start_date']);
			$end = explode(" ", $event['end_date']);
			if($start[1] == '00:00:00'){
				$start = $start[0];
			}else{
				$start = $event['start_date'];
			}
			if($end[1] == '00:00:00'){
				$end = $end[0];
			}else{
				$end = $event['end_date'];
			}
			$events[] = array('id'=>$event['id'], 'start'=>$start ,'end'=>$end ,'title'=>$event['work_type_id'], 'color'=>$event['city_id']); 
        }

        echo json_encode($events); 

        exit;

    }

    elseif($_POST['action'] == "add") // add new event section

    {   

        $user_id = 1;
		$work_type_id = $_POST['work_type_id'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$city_id = $_POST['city_id'];
		$doctor_id = $_POST['doctor_id'];
		$plan_reason = $_POST['plan_reason'];
		$plan_details = $_POST['plan_details'];


		$sql = "INSERT INTO `work_plans`(`user_id`, `work_type_id`, `start_date`, `end_date`, `city_id`, `doctor_id`, `plan_reason`, `plan_details`) values ('$user_id', '$work_type_id', '$start_date', '$end_date', '$city_id', '$doctor_id', '$plan_reason', '$plan_details')";
		//$req = $bdd->prepare($sql);
		//$req->execute();
		
		//echo $sql;
		
		
		$bdd->exec($sql);
		$last_id = $bdd->lastInsertId();
		
		
		echo '{"id":"'.$last_id.'","startTime":"'.$start_date.'","endTime":"'.$end_date.'","title":"'.$work_type_id.'","color":"'.$city_id.'"}';exit;
		if ($sth == false) {
		 print_r($query->errorInfo());
		 die ('Erreur execute');
		}

    }

    elseif($_POST['action'] == "update")  // update event

    {

        $id = $_POST['Event'][0];
		$start = $_POST['Event'][1];
		$end = $_POST['Event'][2];

		$sql = "UPDATE work_plans SET  start_date = '$start', end_date = '$end' WHERE id = $id ";

		
		$query = $bdd->prepare( $sql );
		if ($query == false) {
		 print_r($bdd->errorInfo());
		 die ('Erreur prepare');
		}
		$sth = $query->execute();
		if ($sth == false) {
		 print_r($query->errorInfo());
		 die ('Erreur execute');
		}else{
			die ('OK');
		}

    }
    elseif ($_POST['action'] == "update_event"){
	
		$id = $_POST['id'];
		$work_type_id = $_POST['work_type_id'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$city_id = $_POST['city_id'];
		$doctor_id = $_POST['doctor_id'];
		
		$sql = "UPDATE work_plans SET  work_type_id = '$work_type_id', city_id = '$city_id', doctor_id = '$doctor_id' WHERE id = $id ";

		
		$query = $bdd->prepare( $sql );
		if ($query == false) {
		 print_r($bdd->errorInfo());
		 die ('Erreur prepare');
		}
		$sth = $query->execute();
		echo '{"id":"'.$id.'","startTime":"'.$start_date.'","endTime":"'.$end_date.'","title":"'.$work_type_id.'","color":"'.$city_id.'"}';exit;
		if ($sth == false) {
		 print_r($query->errorInfo());
		 die ('Erreur execute');
		}

	}
    elseif ($_POST['action'] == "get_event"){
	
		$event = $_POST['event'];
		$sql = "SELECT * FROM work_plans where id='".$event."' LIMIT 1";

		$req = $bdd->prepare($sql);
		$req->execute();

		$events = $req->fetch();
		$return_array = array('success' => "1",'work_type_id' => $events['work_type_id'],'start_date' => $events['start_date'],'end_date' => $events['end_date'],'city_id' => $events['city_id'],'doctor_id' => $events['doctor_id'],'plan_reason' => $events['plan_reason'],'plan_details' => $events['plan_details']);
		echo json_encode($return_array);

	}

    elseif($_POST['action'] == "delete")  // remove event

    {
		$id = $_POST['id'];
	
		$sql = "DELETE FROM work_plans WHERE id = $id";
		$query = $bdd->prepare( $sql );
		if ($query == false) {
		 print_r($bdd->errorInfo());
		 die ('Erreur prepare');
		}
		$res = $query->execute();
		if ($res == false) {
		 print_r($query->errorInfo());
		 die ('Erreur execute');
		}
		else
        echo "1";

        exit;

    }

}

?>
