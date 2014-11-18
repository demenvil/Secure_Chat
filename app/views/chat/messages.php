 <div class="conversation">
                                           <?php 
                                                
                                                if(isset($id2)){
                                                
                                                if(empty($messages['conversation'])){
                                                    echo '<span id="nomessage"><b>Saissisez un message</b></span>';
                                                } else {
                                                
                                                    for ($i = 0; $i < count($messages['conversation']); ++$i ){
                                                        if($messages['conversation'][$i]['idE'] == $_SESSION['user']['id'])
                                                            $class = 'bubble-auteur';
                                                        else
                                                            $class = 'bubble-contact';

                                                        if($i == count($messages['conversation']) - 1)
                                                            $class = $class . ' last';
                                                        ?>

                                                        <p class="<?php echo $class; ?>"
                                                            <span class="message">
                                                                <?php 
                                                                    echo utf8_encode($messages['conversation'][$i]['message']); 
                                                                ?>
                                                            </span>
                                                        </p>
                                                <?php
                                                    }
                                                
                                                }
                                            }else{
                                                  echo '<p> Sélectionnez une conversation </p>';
                                            }
                                                
                                            
                                            
                                            
                                            ?>

</div>