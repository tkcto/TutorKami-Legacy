<?php

error_reporting(E_ERROR);
require_once('auth.class.php');


class Log
{

    public static function ActivityLog($type, $user, $msg, $on) {
        $instAuth = new auth();
        $con = $instAuth->con_db();
        $con->query("INSERT INTO " . DB_PREFIX . "_activity_log(atl_at_id,atl_u_id,atl_message,atl_create_date) VALUES('" . $type . "','" . $user . "','" . $msg . "','" . $on . "')");

    }

    public static function FetchActivityLog() {
        $instAuth = new auth();
        $con = $instAuth->con_db();
        return $con->query("SELECT * FROM " . DB_PREFIX . "_activity_log");
    }

    public static function DeleteActivityLog($actid) {
        $instAuth = new auth();
        $con = $instAuth->con_db();
        if ($con->query("DELETE FROM " . DB_PREFIX . "_activity_log WHERE atl_id = '" . $actid . "'")) {
            Session::SetFlushMsg("success", 'Activity Log Deleted Successfully.');
        } else {
            Session::SetFlushMsg("error", 'Deletion Sql failed.');
        }
    }

    public static function SearchActivityLog($data) {
        $instAuth = new auth();
        $con = $instAuth->con_db();

        $query = "SELECT * FROM " . DB_PREFIX . "_activity_log where 1=1";

        if (!empty($data['atl_date_from'])) {
            $fdate = $data['atl_date_from'];
            $query .= " and DATE(atl_create_date) >= '$fdate'";
        }

        if (!empty($data['atl_date_to'])) {
            $tdate = $data['atl_date_to'];
            $query .= " and DATE(atl_create_date) <= '$tdate'";
        }

        if (!empty($data['atl_at_id'])) {
            $acttype = $data['atl_at_id'];
            $query .= " and atl_at_id = '$acttype'";
        }

        return $con->query($query);
    }
}