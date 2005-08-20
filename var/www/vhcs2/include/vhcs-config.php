<?php

function decrypt_db_password ($db_pass) {
     global $vhcs2_db_pass_key;
	 global $vhcs2_db_pass_iv;
	   
    $text = base64_decode("$db_pass\n");
    
    /* Open the cipher */
    $td = mcrypt_module_open ('blowfish', '', 'cbc', '');
    
    /* Create key */
	$key = $vhcs2_db_pass_key;
    
    /* Create the IV and determine the keysize length */
	$iv = $vhcs2_db_pass_iv;
      
    /* Intialize encryption */                    
    mcrypt_generic_init ($td, $key, $iv);
                      
    /* Decrypt encrypted string */    
    $decrypted = mdecrypt_generic ($td, $text);
                          
    mcrypt_module_close ($td);
                                
    /* Show string */                                  
    return trim($decrypted);
}


class Config {
/*
	his class will parse config file and get all variables avaible in PHP
	v. 0.1
*/
    var $config_file;       /* config filename */
    var $cfg_values;        /* array with  options and values that you can get and user :P :) */
    var $status;
    function Config($cfg = "/etc/vhcs2/vhcs2.conf"){
        $this -> config_file = $cfg;
        $this -> status = "ok";
        if ($this->parseFile() == FALSE) {
            $this->status = "err";
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    function parseFile(){
        /* open file ... parse it and put it in $cfg_values */
        @@$fd = fopen($this->config_file,'r');
        if ($fd == FALSE) {
            /* ooops error */
            $this->status = "err";
            return FALSE;
        }

        while(!feof($fd)){
            $buffer = fgets($fd,4096);
            /* remove spaces  */
            $buffer = ltrim($buffer);
            if (strlen($buffer) < 3) {
                /* empty */
            }
            else if ($buffer[0] == '#' || $buffer[0] == ';') {
                /* this is comment */
            }
            else if (strpos($buffer,'=') === false) {
                /* have no = :( */
            }
            else {
                $pair = explode('=',$buffer,2);

                $pair[0] = ltrim($pair[0]);
                $pair[0] = rtrim($pair[0]);

                $pair[1] = ltrim($pair[1]);
                $pair[1] = rtrim($pair[1]);

                /* ok we have it :) */
                $this->cfg_values[$pair[0]]=$pair[1];
            }
        }

        fclose($fd);
        return TRUE;
    }
    function getValues(){
        return $this->cfg_values;
    }
}

?>
