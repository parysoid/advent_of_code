<?php

    class Boxes
    {

        /** @var array|Box[] */
        private array $boxes;



        public function __construct()
        {
            $this->initBoxes();
        }



        /**
         * @return void
         */
        private function initBoxes(): void
        {
            $boxes = [];

            foreach ( range( 0, 255 ) as $boxNumber )
            {
                $boxes[ $boxNumber ] = new Box( $boxNumber );
            }

            $this->setBoxes( $boxes );
        }



        /**
         * @return array
         */
        public function getBoxes(): array
        {
            return $this->boxes;
        }



        /**
         * @param int $boxNumber
         * @return Box|null
         */
        public function getBox( int $boxNumber ): ?Box
        {
            if ( $this->hasBox( $boxNumber ) )
            {
                return $this->getBoxes()[ $boxNumber ];
            }

            return null;
        }



        /**
         * @param int $boxNumber
         * @return bool
         */
        public function hasBox( int $boxNumber ): bool
        {
            return array_key_exists( $boxNumber, $this->getBoxes() );
        }



        /**
         * @param array $boxes
         */
        public function setBoxes( array $boxes ): void
        {
            $this->boxes = $boxes;
        }



        /**
         * @param int $boxNumber
         * @param string $label
         * @param int $focalLength
         * @return void
         */
        public function attachLens( int $boxNumber, string $label, int $focalLength ): void
        {
            if ( !$this->hasBox( $boxNumber ) )
            {
                return;
            }

            $box = $this->getBox( $boxNumber );
            $box->attachLens( $label, $focalLength );
        }



        /**
         * @param int $boxNumber
         * @param string $label
         * @return void
         */
        public function removeLens( int $boxNumber, string $label ): void
        {
            if ( !$this->hasBox( $boxNumber ) )
            {
                return;
            }

            $box = $this->getBox( $boxNumber );
            $box->removeLens( $label );
        }



        /**
         * @return int
         */
        public function getFocusingPower(): int
        {
            $res = 0;

            foreach ( $this->getBoxes() as $box )
            {
                $res += $box->getFocusingPower();
            }

            return $res;
        }


    }