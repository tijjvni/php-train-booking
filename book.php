<?php
    
    $pdo = require_once 'connect.php';
    
    require_once('functions.php');

    $user = authenticate($pdo);


    // select seat
    if( isset($_POST['bookSeat']) ){
        
        extract($_POST);

        // process select seat
        if(empty($ticket) || empty($seat) ){
            echo "All fields are required";
        }else { 

            // insert route
            $sql = 'UPDATE tickets SET seat = :seat WHERE id = :ticket';

            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':seat' => $seat, 
                ':ticket' => $ticket
            ]);
              

            echo 'ticket booked successfully. view your <a href="tickets.php">tickets</a>';            

        }
    }    

    // book
    if( isset($_POST['book']) && !empty($_POST['book']) ){
        
        extract($_POST);

        // process add route
        if(empty($route) || empty($coach) || empty($time)){
            echo "All fields are required";
        }else { 

            // insert route
            $sql = 'INSERT INTO tickets(user_id,coach_id,travel_time_id,route_id) VALUES(:user,:coach,:time,:route)';

            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':user' => $user['id'], 
                ':coach' => $coach,
                ':time' => $time,
                ':route' => $route
            ]);
              

            echo 'Continue to select seat';            

        }
    }    
?>
    <a href="logout.php">logout</a>
    <a href="book.php">book</a>
    <a href="tickets.php">tickets</a>
    <a href="profile.php">profile</a>
<?php
    if($user['is_admin']){
        ?>
            <a href="admin.php">admin</a>
        <?php
    }
?>

<?php
    if(isset($_GET['booked'])){
        ?>
            <form method="post" action="admin.php?booked"> 
                <p> Select Seat</p>
                <?php
                
                    $stmt = $pdo->prepare('SELECT * FROM tickets WHERE user_id = :user AND booked = 0 and order by id desc limit 1');
                    $stmt->execute([
                        ':user' => $user['id'] 
                    ]);            
        
                    $ticket = $stmt->fetch();

                    if($ticket){
                      
                        $stmt = $pdo->prepare('SELECT * FROM routes WHERE id = :route');
                        $stmt->execute([
                            ':route' => $ticket['route_id'] 
                        ]);                           
                        $route = $stmt->fetch();
                      
                        $stmt = $pdo->prepare('SELECT * FROM coaches WHERE id = :coach');
                        $stmt->execute([
                            ':coach' => $ticket['coach_id'] 
                        ]);                           
                        $coach = $stmt->fetch();

                        $stmt = $pdo->prepare('SELECT * FROM travel_times WHERE id = :time');
                        $stmt->execute([
                            ':time' => $ticket['travel_time_id'] 
                        ]);                           
                        $time = $stmt->fetch();

                        ?>
                        <p>
                            <pre><?php echo $route['name']; ?></pre>
                            <pre><?php echo $coach['name']; ?></pre>
                            <pre><?php echo $time['time']; ?></pre>

                            <span>seat</span>
                            <select name="seat">
                            <?php
                                for($x=0; $x < $coach['capacity']; $x++){

                                    $stmt = $pdo->prepare('SELECT * FROM tickets WHERE route_id = :route and coach_id = :coach and travel_time_id = :time and seat = :seat');
                                    $stmt->execute([
                                        ':route' => $route['id'],
                                        ':coach' => $coach['id'],
                                        ':time' => $time['id'],
                                        ':seat' => ($x+1)
                                    ]);                           
                                    $seat = $stmt->fetch();
                                    
                                    if($seat){
                                        ?>
                                            <option disabled="disabled" value="<?php echo ($x+1) ?>"><?php echo ($x+1) ?></option>
                                        <?php
                                    }else {
                                        ?>
                                            <option value="<?php echo ($x+1) ?>"><?php echo ($x+1) ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        </p>

                        <input type="hidden" value="<?php echo $ticket['id'] ?>" name="ticket"/>
                        <input type="submit" value="submit" name="bookSeat"/>
                        <?php
                    }else {
                        header('Location: book.php');
                    }
                ?>

                
            </form>            


        <?php
    }else {
        ?>

            <form method="post" action="admin.php?booked"> 
                <p> Book</p>
                <?php
                    $sql = 'SELECT * from routes'; 
                    $statement = $pdo->query($sql);        
                    $routes = $statement->fetchAll(PDO::FETCH_ASSOC);  
                    
                    $sql = 'SELECT * from coaches'; 
                    $statement = $pdo->query($sql);        
                    $coaches = $statement->fetchAll(PDO::FETCH_ASSOC);  
                    
                    $sql = 'SELECT * from travel_times'; 
                    $statement = $pdo->query($sql);        
                    $times = $statement->fetchAll(PDO::FETCH_ASSOC);  
                    
                    if($routes && $coaches && $time){
                        
                        ?>
                        <p>
                            <span>Route</span>
                            <select name="route">
                            <?php
                                foreach($routes as $route){
                                    ?>
                                        <option value="<?php echo $route['id'] ?>"><?php echo $route['name'] ?></option>
                                    <?php
                                }
                            ?>
                            </select>
                        </p>

                        <p>
                            <span>Coach</span>
                            <select name="coach">
                            <?php
                                foreach($coaches as $coach){
                                    ?>
                                        <option value="<?php echo $coach['id'] ?>"><?php echo $coach['name'] ?></option>
                                    <?php
                                }
                            ?>
                            </select>
                        </p>
                        <p>
                            <span>Time</span>
                            <select name="time">
                            <?php
                                foreach($times as $time){
                                    ?>
                                        <option value="<?php echo $time['id'] ?>"><?php echo $time['time'] ?></option>
                                    <?php
                                }
                            ?>
                            </select>
                        </p>

                        <input type="submit" value="submit" name="book"/>
                        <?php
                    }else {
                        ?>
                            No route available, contact admin.
                        <?php
                    }
                ?>

                
            </form>            



        <?php
    }
