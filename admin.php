<?php
    $pdo = require 'connect.php';
    require_once 'functions.php';

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
        if(empty($coach) || empty($capacity)){
            echo "All fields are required";
        }else { 

            // insert coach
            $sql = 'INSERT INTO coaches(name, capacity) VALUES(:name, :capacity)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':name' => $coach, 
                ':capacity' => $capacity
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

        // process add route
        if(empty($to) || empty($from)){
            echo "All fields are required";
        }else { 
           

            // insert route
            $pdo->query('INSERT INTO routes(from, to) VALUES('.$from.', '.$to.')');

            echo 'Route added successfully.';            

        }
    }

    

    
?>


<form method="post" action="admin.php"> 
    <p> Add Location</p>
    <input type="text" placeholder="location" name="location"/>

    <input type="submit" value="submit" name="addLocation"/>
    
</form>
<form method="post" action="admin.php"> 
    <p> Add Coach</p>
    <input type="text" placeholder="coach name" name="coach"/>
    <input type="number" placeholder="capacity" name="capacity"/>

    <input type="submit" value="submit" name="addCoach"/>
    
</form>
<form method="post" action="admin.php"> 
    <p> Add Travel Time</p>
    <input type="text" placeholder="Travel Time" name="time"/>

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

            <input type="submit" value="submit" name="addRoute"/>
            <?php
        }else {
            ?>
                Add location before adding route
            <?php
        }
    ?>

    
</form>

