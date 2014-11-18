<ul> 
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Rechercher un utilisateur ..." id="user_input"/>
    </form>
    <p class="search">
        <?php include ('search.php'); ?>
    </p>
    <div class="list-conversation">
        Connecté sous 
        <b>
            <?php
                $user = Message::getArrayUser($_SESSION['user']['id']);
                echo $user['firstname'] . ' ' . $user['lastname'];
            ?>
        </b><br/>
        <li><a href="/home/logout">Se deconnecter</a></li>
        <?php
            $id = $_SESSION['user']['id'];
            $result = Message::listConversations($id);
     
            $val = array();
            $i = 0;
            
            foreach ($result as $value){

               if(isset($_SESSION['idR'])){
                   if(!in_array($value['idR'], $val) && $value['idR'] == $_SESSION['idR']){
                     $selectVal = $value['idR'];

                   } else if (!in_array($value['idE'], $val) && $value['idE'] == $_SESSION['idR']){
                       $selectVal = $value['idE'];  
                   }
               }
                  if(!isset($selectVal)){
                      $selectVal = 0;
                  }
                   $select = '';
                   
                   
               // if we already have dislay this contact we do not display 
               if(!in_array($value['idR'], $val) && $value['idR'] != $_SESSION['user']['id']){
                    $value['user'] = Message::getArrayUser($value['idR']);
                    
                    if ($selectVal == $value['idR']){
                        $select = 'select';
                    }
                    
                    echo ' <li class="contact ' . $select . '" id="' . $value['idR'] . '">';
                    echo '<a href="#"> '. $value['user']['firstname'] . ' ' . $value['user']['lastname'];
                    echo '</a></li>';
         
                    $val[$i] = $value['idR'];
                    ++$i;
                    $select = '';
               }
               
               if(!in_array($value['idE'], $val) && $value['idE'] != $_SESSION['user']['id']){
                    $value['user'] = Message::getArrayUser($value['idE']);
                   
                    if ($selectVal == $value['idE']){
                        $select = 'select';
                    }
                    
                    echo ' <li class="contact ' . $select . '" id="' . $value['idE'] . '">';
                    echo '<a href="#"> '. $value['user']['firstname'] . ' ' . $value['user']['lastname'];
                    echo '</a></li>';
                    
                    $val[$i] = $value['idE'];
                    ++$i;
                    $select = '';
               }
            }
        ?>
    </div>
</ul>
