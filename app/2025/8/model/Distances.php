<?php

    namespace Playground;

    class Distances
    {

        /** @var array|Distance[] */
        private array $distances;



        /**
         *
         */
        public function __construct()
        {
            $this->setDistances( [] );
        }



        /**
         * @return array
         */
        public function getDistances(): array
        {
            return $this->distances;
        }



        /**
         * @param array $distances
         */
        public function setDistances( array $distances ): void
        {
            $this->distances = $distances;
        }



        /**
         * @param Distance $distance
         * @return void
         */
        public function attachDistance( Distance $distance ): void
        {
            $this->distances[] = $distance;
        }



        /**
         * @return void
         */
        public function sortDistances(): void
        {
            usort( $this->distances, function ( Distance $a, Distance $b ) {
                return $a->getDistance() > $b->getDistance();
            } );
        }


    }