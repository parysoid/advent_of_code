<?php

    class Lens
    {

        /** @var string */
        private string $label;

        /** @var int */
        private int $focalLength;

        /** @var int */
        private int $order;



        /**
         * @param string $label
         * @param int $focalLength
         * @param int $order
         */
        public function __construct( string $label, int $focalLength, int $order )
        {
            $this->setLabel( $label );
            $this->setFocalLength( $focalLength );
            $this->setOrder( $order );
        }



        /**
         * @return string
         */
        public function getLabel(): string
        {
            return $this->label;
        }



        /**
         * @param string $label
         */
        public function setLabel( string $label ): void
        {
            $this->label = $label;
        }



        /**
         * @return int
         */
        public function getFocalLength(): int
        {
            return $this->focalLength;
        }



        /**
         * @param int $focalLength
         */
        public function setFocalLength( int $focalLength ): void
        {
            $this->focalLength = $focalLength;
        }



        /**
         * @return int
         */
        public function getOrder(): int
        {
            return $this->order;
        }



        /**
         * @param int $order
         */
        public function setOrder( int $order ): void
        {
            $this->order = $order;
        }



    }