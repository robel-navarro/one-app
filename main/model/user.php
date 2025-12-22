<?php
class UserData
{

    public static function getUserAccess2($username)
    {
        $database = new DB;
        $database->query(
            'SELECT user_level,employee_id,user_password FROM pb_rtdc_cognex.user_access
            WHERE user_name = :user_name AND user_status = :user_status'
        );
        $database->bind(':user_name', $username);
        $database->bind(':user_status', 1);
        return $database->single();
    }

    public static function getUserData($employee_id)
    {
        $database = new DB;
        $database->query("SELECT employee_id,concat(first_name,' ',last_name) as employee_name,
							designation,department FROM pb_rtdc_cognex.employee WHERE employee_id=:employee_id");
        $database->bind(':employee_id', $employee_id);
        return $database->single();
    }
}
