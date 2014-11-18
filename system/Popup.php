<?php
/**
 *  This class create the right Popup if the user is logged in or not
 */
class Popup {
    
    private $title;
    private $message;
    private $type;

    public static function set($title, $message, $type = 'error'){
       $params = array(
           'title'      => $title,
           'message'    => $message,
           'type'       => $type
       );
       
       $_SESSION['popup'] = $params;
       
   }
   
   public static function get()
   {
       if(isset($_SESSION['popup'])) {
           $popup = $_SESSION['popup'];
           unset($_SESSION['popup']);
           return $popup;
       }
       
       return array(
           'title'      =>  null,
           'message'    =>  null,
           'type'       =>  null
       );
   }
   
   public static function display() {
       $popup = self::get();
       
       if(!empty($popup['title']) && !empty($popup['message']) && !empty($popup['type'])){
           $return = '<div class="popup ' . $popup['type'] . '">
                        <h2>' . $popup['title'] . '</h2>
                          <p> ' . $popup['message'] . '
                          </p>
                            <div class = "cross">
                              <a onclick="$(\'.popup\').fadeOut(\'slow\'); return false;" id="close_popup">
                                X 
                              </a> 
                            </div>
                        </div>';
           return $return;
       } else
           return FALSE;
   }
} 