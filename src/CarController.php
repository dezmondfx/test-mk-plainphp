<?php

namespace Motork;


class CarController
{
    /**
     * Index Action
     *
     * This should contain the list of cars.
     */
    public function getIndex()
    {
        include CONFIG_VIEWS_DIR . '/index.php';
    }

    /**
     * Detail Action
     *
     * This should contain the car's detail and the form.
     */
    public function getDetail($carId)
    {
        $car = json_decode(file_get_contents('http://localhost:8889/api.php/detail/'.$carId));
        $car = $car->data;
        $similarCars = $this->getSimilarCarsDetails($car);

        include CONFIG_VIEWS_DIR . '/detail.php';
    }

    /**
     * Get 6 similars cars based on some attributes
     *
     */
    public function getSimilarCarsDetails($car)
    {
        // number of similar cars to retreive
        $similarCarsQuantity = 6;

        // get Current Car tags
        $currentCarId = $car->attrs->carId;
        $carTags = $car->tags;
        $internalSpace = $carTags->{'Internal space'};
        $segment = $carTags->Segment;
        $fuelType = $carTags->{'Fuel type'};
        $look = $carTags->Look;
        $price = $carTags->Price;

        $carCatalogue = json_decode(file_get_contents('http://localhost:8889/api.php/search/' ));

        // check affinity score foreach car
        $similarCarsIds = array();
        foreach ($carCatalogue->data as $car) {

            $affinityScore = 0;

            // the attribution method must be improved
            ($internalSpace === $car->tags->{'Internal space'}) ? $affinityScore++ : null;
            ($segment === $car->tags->Segment) ? $affinityScore++ : null;
            ($fuelType === $car->tags->{'Fuel type'}) ? $affinityScore++ : null;
            ($look === $car->tags->Look) ? $affinityScore++ : null;
            ($price === $car->tags->Price) ? $affinityScore++ : null;

            $similarCarsIds[$car->attrs->carId] = $affinityScore;
        }

        // get first best results and return an array with cars details
        unset($similarCarsIds[$currentCarId]);
        arsort($similarCarsIds);
        $slicedSimilarCars = array_slice($similarCarsIds, 0, $similarCarsQuantity, true);

        $similarCars = array();
        $i = 0;
        foreach ($slicedSimilarCars as $key => $val) {

            $car = json_decode(file_get_contents('http://localhost:8889/api.php/detail/'.$key));
            $similarCars[$i] = $car->data;

            $i++;
        }

        return $similarCars;
    }


    /**
     * @return CarController
     */
    public static function create()
    {
        return new self();
    }
}