<?php

namespace Motork;

use PHPUnit\Framework\TestCase;
use Motork\CarController;
use Motork\LeadController;

class SampleTest extends TestCase {

	public function testDetailPage() {

        $handle = curl_init("http://localhost:8889/api.php/detail/566");
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        $this->assertTrue( $httpCode == 200, "<error>Details page not retrieved </error>" );
    }

    public function testNotPresentDetailPage() {

        $handle = curl_init("http://localhost:8889/api.php/detail/5686");
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        $this->assertTrue( $httpCode == 400, "<error>Invalid carId page not not working </error>" );
    }

    public function testIndexPage() {

        $handle = curl_init("http://localhost:8888");
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        $this->assertTrue( $httpCode == 200, "<error>Index page not retrieved </error>" );
    }

    public function testCarControllerGetDetails() {

        $car = json_decode(file_get_contents('http://localhost:8889/api.php/detail/566'));
        $car = $car->data;

        $CarController = new CarController();
        $response = $CarController->getSimilarCarsDetails($car);

        $this->assertTrue( is_array($response) == true, "<error> SimilarCar page not retrieved array </error>" );
    }

    public function testNewLead() {

        $handle = curl_init("http://localhost:8888/newLead");

        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS,
            "name=test&surname=surnametest&email=test@gmail.com&phone=320000000&zip=70000&privacy=Y&carId=566");
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        $this->assertTrue( $httpCode == 201, "<error>New Lead page not not working </error>" );
    }

    public function testShowLeads() {

        $handle = curl_init("http://localhost:8888/getLeads");
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        $this->assertTrue( $httpCode == 200, "<error>Get Lead page not not working </error>" );
    }

}