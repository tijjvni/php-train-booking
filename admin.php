<?php
    $pdo = require 'connect.php';

    authenticate();
    adminPage($user);

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
        
        if($routes){
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
        
    ?>

    <input type="submit" value="submit" name="addRouteCoach"/>

</form>