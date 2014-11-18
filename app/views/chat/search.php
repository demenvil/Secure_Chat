<p class="result">
    <?php
        
        if(!empty($_POST['username'])){
            $result = User::getUserByName($_POST['username']);
        foreach($result as $value){
    ?>
    
    <a href="#" id="<?php echo $value['id'];?>" class="userStart">
        <span class="user">
            <?php echo $value['firstname'] . ' ' . $value['lastname']; ?>
        </span>
        <span class="plus"> + </span>
    </a>
    <br/>
        <?php }
        }?>
</p>