
    // add location
    if( isset($_POST['addLocation']) && !empty($_POST['addLocation']) ){
        
        extract($_POST);

        // process add location
        if(empty($location)){
            echo "All fields are required";
        }else { 

            // insert location
            $sql = 'INSERT INTO locations(name) VALUES(:name)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':name' => $location
            ]);


            echo 'Location added successfully.';            

        }
    }

    // add coach
    if( isset($_POST['addCoach']) && !empty($_POST['addCoach']) ){
        
        extract($_POST);

        // process add coach
        if(empty($coach)){
            echo "All fields are required";
        }else { 

            // insert coach
            $sql = 'INSERT INTO coaches(name) VALUES(:name)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':name' => $coach
            ]);


            echo 'Coach added successfully.';            

        }
    }

    // add time
    if( isset($_POST['addTime']) && !empty($_POST['addTime']) ){
        
        extract($_POST);

        // process add time
        if(empty($time)){
            echo "All fields are required";
        }else { 

            // insert time
            $sql = 'INSERT INTO travel_times(time) VALUES(:time)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':time' => $time
            ]);


            echo 'Time added successfully.';            

        }
    }

    // add route
    if( isset($_POST['addRoute']) && !empty($_POST['addRoute']) ){
        
        extract($_POST);

        // process add coach
        if(empty($to) || empty($from)){
            echo "All fields are required";
        }else { 

            // insert route
            $sql = 'INSERT INTO routes(to,from) VALUES(:to,:from)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':to' => $to,
                ':from' => $from
            ]);


            echo 'Route added successfully.';            

        }
    }

    // add route coaches
    if( isset($_POST['addRouteCoach']) && !empty($_POST['addRouteCoach']) ){
        
        extract($_POST);

        // process add coach
        if(empty($route) || empty($coach)){
            echo "All fields are required";
        }else { 

            // insert location
            $sql = 'INSERT INTO route_coaches(route,coach) VALUES(:route,:coach)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':route' => $route,
                ':coach' => $coach
            ]);


            echo 'Route Coach added successfully.';            

        }
    }

?>
