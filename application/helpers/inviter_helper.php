<?php


     function grab_contacts($plugin,$username,$password)
    {
        require_once($this->ci->config->item('absolute_url').'openinviter/openinviter.php');
        
        $oi    = new OpenInviter();
        
        $oi->startPlugin($plugin);
        //First modification , added the if clause
        if($oi->login($username,$password))
        {
            $array        =     $oi->getMyContacts();
            
            if(is_array($array) && count($array)>=1)
            {
                $this->imported        =    $array;
                
                $this->_store_invited();
                
                return($this->imported);
            }else{
                return;
            }
        }
        else
        {
        return 'ERROR on login.';
        }
    }
    
 

?> 