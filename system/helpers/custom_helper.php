<?php 
if(!function_exists('debug_log'))
{
   function debug_log($data) {
       if (config_item('debug_mode')) {

            if(strpos(print_r($data, true), '[dbdriver] => mysqli') == false){
                $fp = fopen('.debug.log', 'a');        
                fwrite($fp, date('Y-m-d H:i:s') . ": " . print_r($data, true) . "\n");
                fclose($fp);
            }

            if(filesize('.debug.log')/1024 > 50){

                file_put_contents('.debug_repo.log', file_get_contents('.debug.log'), FILE_APPEND | LOCK_EX);

                $fh = fopen('.debug.log', 'w' );
                fclose($fh);
            }
        }
    }
}
?>