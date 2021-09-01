<?php
    $pdo = require_once 'connect.php';
    require_once('functions.php');

    $user = authenticate($pdo);
    adminPage($user);


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


<form method="post" action="admin.php"> 
    <p> Add Location</p>
    <input type="text" placeholder="location" name="location"/>

    <input type="submit" value="submit" name="addLocation"/>
    
</form>
<form method="post" action="admin.php"> 
    <p> Add Time</p>
    <input type="text" placeholder="time" name="time"/>

    <input type="submit" value="submit" name="addTime"/>
    
</form>
<form method="post" action="admin.php"> 
    <p> Add Coach</p>
    <input type="text" placeholder="coach name" name="coach"/>
    <input type="number" placeholder="capacity" name="capacity"/>

    <input type="submit" value="submit" name="addCoach"/>
    
</form>
<form method="post" action="admin.php"> 
    <p> Add Travel Time</p>
    <input type="time" placeholder="Travel Time" name="time"/>

    <input type="submit" value="submit" name="addTime"/>
    
</form>
<form method="post" action="admin.php"> 
    <p> Add Route</p>
    <?php
        $sql = 'SELECT * from locations'; 
        $statement = $pdo->query($sql);        
        $locations = $statement->fetchAll(PDO::FETCH_ASSOC);  
        
        if($locations){
            
            ?>
            <p>
                <span>From</span>
                <select name="from">
                <?php
                    foreach($locations as $location){
                        ?>
                            <option value="<?php echo $location['id'] ?>"><?php echo $location['name'] ?></option>
                        <?php
                    }
                ?>
                </select>
            </p>
                <p>
                    <span>To</span>
                    <select name="to">
                    <?php
                        foreach($locations as $location){
                            ?>
                                <option value="<?php echo $location['id'] ?>"><?php echo $location['name'] ?></option>
                            <?php
                        }
                    ?>
                    </select>
                </p>

                <select name="from">
                <?php
                    foreach($locations as $location){
                        ?>
                            <option value="<?php echo $location['id'] ?>"><?php echo $location['name'] ?></option>
                        <?php
                    }
                ?>
                </select>
            <input type="submit" value="submit" name="addRoute"/>
            <?php
        }else {
            ?>
                Add location before adding route
            <?php
        }
    ?>

    
</form>

<form method="post" action="admin.php"> 
    <p> Add Route Coach</p>
    <?php
        $sql = 'SELECT * from routes'; 
        $statement = $pdo->query($sql);        
        $routes = $statement->fetchAll(PDO::FETCH_ASSOC);  
        
        if($routes){
            ?>
                <p>
                    <span>Route</span>
                    <select name="from">
                    <?php
                        foreach($routes as $route){
                            ?>
                                <option value="<?php echo $route['id'] ?>"><?php echo $route['name'] ?></option>
                            <?php
                        }
                    ?>
                    </select>
                </p>
                
            <?php
        }else {
            ?>
                Add route first
            <?php
        }

        $sql = 'SELECT * from coaches'; 
        $statement = $pdo->query($sql);        
        $coaches = $statement->fetchAll(PDO::FETCH_ASSOC);  
        
        if($coaches){
            ?>
                <p>
                    <span>Coach</span>
                    <select name="from">
                    <?php
                        foreach($coaches as $coach){
                            ?>
                                <option value="<?php echo $coach['id'] ?>"><?php echo $coach['name'] ?></option>
                            <?php
                        }
                    ?>
                    </select>
                </p>
                
            <?php
        }else {
            ?>
                Add coach first
            <?php
        }
        
        if($coaches && $routes){
            ?>
                <input type="submit" value="submit" name="addRouteCoach"/>
            <?php
        }

    ?>

</form>