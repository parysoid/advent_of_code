<?php

    namespace Playground;

    class Distance
    {

        /** @var Box */
        private Box $boxA;

        /** @var Box */
        private Box $boxB;

        /** @var float */
        private float $distance;



        /**
         * @param Box $boxA
         * @param Box $boxB
         * @param float $distance
         */
        public function __construct( Box $boxA, Box $boxB, float $distance )
        {
            $this->setBoxA( $boxA );
            $this->setBoxB( $boxB );
            $this->setDistance( $distance );
        }



        /**
         * @return Box
         */
        public function getBoxA(): Box
        {
            return $this->boxA;
        }



        /**
         * @param Box $boxA
         */
        public function setBoxA( Box $boxA ): void
        {
            $this->boxA = $boxA;
        }



        /**
         * @return Box
         */
        public function getBoxB(): Box
        {
            return $this->boxB;
        }



        /**
         * @param Box $boxB
         */
        public function setBoxB( Box $boxB ): void
        {
            $this->boxB = $boxB;
        }



        /**
         * @return float
         */
        public function getDistance(): float
        {
            return $this->distance;
        }



        /**
         * @param float $distance
         */
        public function setDistance( float $distance ): void
        {
            $this->distance = $distance;
        }


    }