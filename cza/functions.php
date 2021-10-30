
 <?php
    /* 
        Must have app/view  folder
    */
    
 function _get_view($view, $data = null){
        $file = DD . "/app/view/" . $view . ".php";

        if(file_exists($file)) {
            ob_start();
            if($data != null )   {
                extract($data);
            }
            require $file;
            ob_end_flush();
        } else {
         trigger_error ("View ဖိုဒါ မွာ view file မရွိဘူးဟ။ ေသာက္ရူးရ။", E_USER_ERROR);
        }
    }

    /* 
    ** must have app/config folder
    */

    function _config_get($config_value) {
        $e_value = explode(".", $config_value);
        $config_file = DD . "/app/config/" . $e_value[0] . ".php";
        if(file_exists($config_file)) {
           $config_value = require $config_file;
           if(array_key_exists($e_value[1], $config_value)) {
               return $config_value[$e_value[1]];
           } else {
               trigger_error("Config key not found", E_USER_ERROR);
           }
        } else {
            trigger_error("Config file not found!", E_USER_ERROR);
        }
    }
    /**
     * must have app/lang/en folder
     */
     function _lang_get(string $lang_value) {
         $e_lang_value = explode(".", $lang_value);
         $file = DD . "/app/lang/" . _config_get("app.lang") . "/" . $e_lang_value[0] . ".php";
         if(file_exists($file)) {
           $lang_val = require $file;
           if(array_key_exists($e_lang_value[1], $lang_val)) {
               return $lang_val[$e_lang_value[1]];
           } else {
               trigger_error("Language Key not found!", E_USER_ERROR);
           }
         } else {
             trigger_error("Language file not found", E_USER_ERROR);
         }
     }
   
    function _dump($value, $die = false) {
        var_dump($value);
        if($die == true) {
            die();
        }
    }

    function _check_empty($value) {
        if(empty(trim($value))) {
            return true;
        }
         return false;
    }

    function _check_equal($first, $second) {
        if($first != $second) {
            return true;
        }
        return false;
    }
    function _check_count($value, $count = 1) {
        if(strlen($value) < $count) {
            return true;
        }
        return false;
    }
   ?>