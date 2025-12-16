<?php

    namespace Playground;

    class Connections
    {


        /** @var Boxes */
        private Boxes $boxes;

        /** @var array */
        private array $parents;

        /** @var array */
        private array $sizes;



        /**
         * @param Boxes $boxes
         */
        public function __construct( Boxes $boxes )
        {
            $this->setBoxes( $boxes );
            $this->setParents( [] );
            $this->setSizes( [] );
        }



        /**
         * @return Boxes
         */
        public function getBoxes(): Boxes
        {
            return $this->boxes;
        }



        /**
         * @param Boxes $boxes
         */
        public function setBoxes( Boxes $boxes ): void
        {
            $this->boxes = $boxes;
        }



        /**
         * @return array
         */
        public function getParents(): array
        {
            return $this->parents;
        }



        /**
         * @param array $parents
         */
        public function setParents( array $parents ): void
        {
            $this->parents = $parents;
        }



        /**
         * @return array
         */
        public function getSizes(): array
        {
            return $this->sizes;
        }



        /**
         * @param array $sizes
         */
        public function setSizes( array $sizes ): void
        {
            $this->sizes = $sizes;
        }



        /**
         * @param array|Box[] $boxes
         * @return void
         */
        public function initBoxes( array $boxes ): void
        {
            foreach ( $boxes as $key => $box )
            {
                $this->parents[ $box->getId() ] = $box->getId();
                $this->sizes[ $box->getId() ] = 1;
            }
        }



        /**
         * @param Distance $distance
         * @return void
         */
        public function handleDistance( Distance $distance ): void
        {
            $parentIdBoxA = $this->findParentId( $distance->getBoxA()->getId() );
            $parentIdBoxB = $this->findParentId( $distance->getBoxB()->getId() );

            if ( $parentIdBoxA === $parentIdBoxB )
            {
                return;
            }

            if ( $this->sizes[ $parentIdBoxA ] < $this->sizes[ $parentIdBoxB ] )
            {
                [ $parentIdBoxA, $parentIdBoxB ] = [ $parentIdBoxB, $parentIdBoxA ];
            }

            $this->parents[ $parentIdBoxB ] = $parentIdBoxA;
            $this->sizes[ $parentIdBoxA ] += $this->sizes[ $parentIdBoxB ];
        }



        /**
         * @param int $id
         * @return int
         */
        public function findParentId( int $id ): int
        {
            if ( $this->parents[ $id ] !== $id )
            {
                $x = $this->findParentId( $this->parents[ $id ] );
                $this->parents[ $id ] = $x;
                return $x;
            }

            return $this->parents[ $id ];
        }



        /**
         * @param int $limit
         * @return int
         */
        public function getResultTopProduct( int $limit = 3 ): int
        {
            $res = [];

            foreach ( $this->getBoxes()->getBoxes() as $box )
            {
                $parentId = $this->findParentId( $box->getId() );

                if ( !array_key_exists( $parentId, $res ) )
                {
                    $res[ $parentId ] = $this->sizes[ $parentId ];
                }
            }

            arsort( $res );

            return array_product( array_slice( $res, 0, $limit, true ) );
        }


    }