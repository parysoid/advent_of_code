<?php

    namespace Playground;

    class Boxes
    {

        /** @var array|Box[] */
        private array $boxes;



        public function __construct()
        {
            $this->setBoxes( [] );
        }



        /**
         * @param Box $box
         * @return void
         */
        public function attachBox( Box $box ): void
        {
            $this->boxes[ $box->getId() ] = $box;
        }



        /**
         * @param int $id
         * @return Box
         */
        public function getBox( int $id ): Box
        {
            return $this->boxes[ $id ];
        }



        /**
         * @return array
         */
        public function getBoxes(): array
        {
            return $this->boxes;
        }



        /**
         * @return int
         */
        public function getBoxesCount(): int
        {
            return count( $this->boxes );
        }



        /**
         * @param array $boxes
         */
        public function setBoxes( array $boxes ): void
        {
            $this->boxes = $boxes;
        }



        /**
         * @param array $lines
         * @return Boxes
         */
        public static function hydrateBoxes( array $lines ): Boxes
        {
            $res = new Boxes();
            $id = 1;

            foreach ( $lines as $line )
            {
                [ $x, $y, $z ] = explode( ',', $line );
                $box = new Box( $id, $x, $y, $z );

                $res->attachBox( $box );
                $id++;
            }

            return $res;
        }


    }