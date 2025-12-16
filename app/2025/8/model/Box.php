<?php

    namespace Playground;

    class Box
    {

        /** @var int */
        private int $id;

        /** @var int */
        private int $x;

        /** @var int */
        private int $y;

        /** @var int */
        private int $z;



        /** @var string */
        private string $key;



        /**
         * @param int $id
         * @param int $x
         * @param int $y
         * @param int $z
         */
        public function __construct( int $id, int $x, int $y, int $z )
        {
            $this->setId( $id );
            $this->setX( $x );
            $this->setY( $y );
            $this->setZ( $z );
        }



        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }



        /**
         * @param int $id
         */
        public function setId( int $id ): void
        {
            $this->id = $id;
        }



        /**
         * @return int
         */
        public function getX(): int
        {
            return $this->x;
        }



        /**
         * @param int $x
         */
        public function setX( int $x ): void
        {
            $this->x = $x;
        }



        /**
         * @return int
         */
        public function getY(): int
        {
            return $this->y;
        }



        /**
         * @param int $y
         */
        public function setY( int $y ): void
        {
            $this->y = $y;
        }



        /**
         * @return int
         */
        public function getZ(): int
        {
            return $this->z;
        }



        /**
         * @param int $z
         */
        public function setZ( int $z ): void
        {
            $this->z = $z;
        }



    }