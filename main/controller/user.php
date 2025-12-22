<?php
class User{
    private $employeeId;
    private $employeeName;
    private $employeeDesignation;
    private $employeeDepartment;
    private $employeeUserLevel;

    //USING RTDC ACCOUNT
     public function login2 ($username, $password) {//Ok
        $user_access = UserData::getUserAccess2($username);
        if (password_verify($password, $user_access['user_password'])) {
            $user_info = UserData::getUserData($user_access['employee_id']);


            $this->employeeId = $user_info['employee_id'];
            $this->employeeName = $user_info['employee_name'];
            $this->employeeDesignation = $user_info['designation'];
            $this->employeeDepartment = $user_info['department'];
            $this->employeeUserLevel = $user_access['user_level'];

            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $this->employeeName;
            $_SESSION['user_id'] = $this->employeeId;
            $_SESSION['designation'] = $this->employeeDesignation;
            $_SESSION['department'] = $this->employeeDepartment;
            $_SESSION['user_level'] = $this->employeeUserLevel;
            $_SESSION['logged_in'] = 1;    

            $result = array('status' => 'success', 'message' => 'User Successfully login into the system.');
        } else {
            $_SESSION['logged_in'] = 0;
            $result = array('status' => 'error', 'message' =>  'User unable to login into the system.');
        }

        return $result;
    }

    
     public function LoginDomainUser($username, $pass)
    {
        try {
            $user = $username;
            $password = $pass;
            $ldap_dn = "DC=pciltd,DC=com,DC=sg";
            $ldap_usr_dom = '@pciltd.com.sg';
            $ldap = ldap_connect("ldap://pbdc01.pciltd.com.sg:389");
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
            if (ldap_bind($ldap, $user . $ldap_usr_dom, $password)) {
              $filter = "(sAMAccountName=" . $user . "*)";
              $attr = array("department", "mail", "title", "cn");
              $result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
              $entries = ldap_get_entries($ldap, $result);
              $entry_count = ldap_count_entries($ldap, $result);
              ldap_unbind($ldap);
              $NameEntry = array();
             
                  // echo  $i . '. ' . $entries[$i]['cn']['0'] . '</br>';
                  $new_data = array();
                  $new_data['name'] =  $entries[0]['cn']['0'];
                  $new_data['email'] = $entries[0]['mail']['0'];
                  $NameEntry[] = $new_data;
                  if( $entries[0]['cn']['0']!== ''){
                    $_SESSION['logged_in'] = 1;
                    $_SESSION['name'] =$entries[0]['cn']['0'];
                    $_SESSION['show_full_menu'] = true;

                    $_SESSION['username'] = $username;
                    $_SESSION['fullname'] =  $entries[0]['cn']['0'];
                    $_SESSION['user_id'] = "1";
                    $_SESSION['designation'] ="1";
                    $_SESSION['department'] = "1";
                    $_SESSION['user_level'] =1;
                    $_SESSION['logged_in'] = 1;
              
                    $result = array('status' => 'success', 'message' => 'User Successfully login into the system.');
                  }else{
                    $_SESSION['logged_in'] = 0;
                    $_SESSION['show_full_menu'] = false;
                    $result = array('status' => 'error', 'message' =>  'User unable to login into the system.');
                  }
            } else {
                $_SESSION['logged_in'] = 0;
                $result = array('status' => 'error', 'message' =>  'User unable to login into the system.');
            }
            return $result;
          } catch (Exception $e) {
            return array('status' => 'error', 'Error' => $e->getMessage());
          }
          

    }

    public function logout() {//Ok
        if(isset($_SESSION['username'])) {
            unset($_SESSION['username']);
        }
        if(isset($_SESSION['fullname'])) {
            unset($_SESSION['fullname']);
        }
        if(isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }
        if(isset($_SESSION['designation'])) {
            unset($_SESSION['designation']);
        }
        if(isset($_SESSION['department'])) {
            unset($_SESSION['department']);
        }
        if(isset($_SESSION['user_level'])) {
            unset($_SESSION['user_level']);
        }
        if(isset($_SESSION['logged_in'])) {
            unset($_SESSION['logged_in']);
        }
        session_destroy();

        return "User Successfully logout from the system.";
    }
}