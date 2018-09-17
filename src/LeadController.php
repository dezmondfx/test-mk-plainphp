<?php

namespace Motork;


class LeadController
{

    /**
     * Send a lead in DB
     */
    public function sendLead($lead)
    {
        $myPDO = new \PDO('sqlite:../data/motork_dev_test');

        $sql = 'INSERT INTO leads VALUES (:id, :firstname, :lastname, :email, :phone, :cap, :privacy, :carId)';
        $stmt = $myPDO->prepare($sql);
        $stmt->execute([
            ':id'   => null,
            ':firstname' => $lead['firstname'],
            ':lastname' => $lead['lastname'],
            ':email' => $lead['email'],
            ':phone' => $lead['phone'],
            ':cap' => $lead['cap'],
            ':privacy' => $lead['privacy'],
            ':carId' => $lead['carId'],
        ]);

        return header("location: /successLead", "",201);
    }

    /**
     * Get All Leads and show in a page (only for debug purpose)
     */
    public function getLeads()
    {
        $myPDO = new \PDO('sqlite:../data/motork_dev_test');

        $results = $myPDO->query("SELECT * FROM leads");

        $leads = array();
        $i = 0;
        while ($row = $results->fetchObject()) {
            $leads[$i] = $row;
            $i++;
        }

        include CONFIG_VIEWS_DIR . '/showLeads.php';
    }

    /**
     * Success Lead
     *
     * This should contain the list of cars.
     */
    public function getSuccessLead()
    {
        include CONFIG_VIEWS_DIR . '/successLead.php';
    }

    /**
     * @return LeadController
     */
    public static function create()
    {
        return new self();
    }
}