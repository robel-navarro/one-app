<?php
class Analysis_Form
{

    public function GetTriggeringDefect()
    {
        return Analysis_FormData::GetTriggeringDefect();
    }

      public function GetTriggeringDefect_AutoEmail()
    {
        return Analysis_FormData::GetTriggeringDefect_AutoEmail();
    }


    public function Add($data)
    {
        $check = Analysis_FormData::checkifExists($data);

        if ($check) {
            //exists// just update
          $update = Analysis_FormData::Update($data);
            if ($update) {
                return array(
                    'success' => 'success',
                    'message' => 'Successfully update to database'
                );
            } else {
                return array(
                    'error' => 'error',
                    'message' => 'Unable to add to database'
                );
            }
        } else {
            $add = Analysis_FormData::Add($data);
            if ($add) {
                return array(
                    'success' => 'success',
                    'message' => 'Successfully add to database'
                );
            } else {
                return array(
                    'error' => 'error',
                    'message' => 'Unable to add to database'
                );
            }
        }
    }
}
