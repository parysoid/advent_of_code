<?php

    class Box
    {

        /** @var int */
        private int $boxNumber;

        /** @var Lens[]|array */
        private array $lenses;



        /**
         * @param int $number
         */
        public function __construct( int $number )
        {
            $this->setBoxNumber( $number );

            $this->setLenses( [] );
        }



        /**
         * @return int
         */
        public function getBoxNumber(): int
        {
            return $this->boxNumber;
        }



        /**
         * @param int $boxNumber
         */
        public function setBoxNumber( int $boxNumber ): void
        {
            $this->boxNumber = $boxNumber;
        }



        /**
         * @return array
         */
        public function getLenses(): array
        {
            return $this->lenses;
        }



        /**
         * @param string $label
         * @return Lens|null
         */
        public function getLens( string $label ): ?Lens
        {
            return $this->hasLens( $label ) === true ? $this->getLenses()[ $label ] : null;
        }



        /**
         * @param array $lenses
         */
        public function setLenses( array $lenses ): void
        {
            $this->lenses = $lenses;
        }



        /**
         * @param string $label
         * @param int $focalLength
         * @return void
         */
        public function attachLens( string $label, int $focalLength ): void
        {
            if ( $this->hasLens( $label ) )
            {

                $this->replaceLens( $label, $focalLength );
                return;
            }

            $this->lenses[ $label ] = new Lens( $label, $focalLength, $this->getLastLensOrder() + 1 );
        }



        /**
         * @param string $label
         * @return void
         */
        public function removeLens( string $label ): void
        {
            if ( !$this->hasLens( $label ) )
            {
                return;
            }

            unset( $this->lenses[ $label ] );
            $this->moveLensesForward();
        }



        /**
         * @return void
         */
        public function moveLensesForward(): void
        {
            $lenses = $this->getLenses();

            usort( $lenses, function ( Lens $a, Lens $b ) {
                return $a->getOrder() > $b->getOrder() ? 1 : 0;
            } );

            $order = 1;

            foreach ( $lenses as $lens )
            {
                $lens->setOrder( $order );
                $order++;
            }
        }



        /**
         * @param string $label
         * @return bool
         */
        public function hasLens( string $label ): bool
        {
            return array_key_exists( $label, $this->getLenses() );
        }



        /**
         * @return bool
         */
        public function hasLenses(): bool
        {
            return count( $this->getLenses() ) > 0;
        }



        /**
         * @param string $label
         * @param int $focalLength
         * @return void
         */
        public function replaceLens( string $label, int $focalLength )
        {
            $lens = $this->getLens( $label );

            if ( $lens )
            {
                $lens->setFocalLength( $focalLength );
            }
        }



        /**
         * @return int
         */
        public function getLastLensOrder(): int
        {
            if ( !$this->hasLenses() )
            {
                return 0;
            }

            $lenses = $this->getLenses();

            usort( $lenses, function ( Lens $a, Lens $b ) {
                return $a->getOrder() < $b->getOrder() ? 1 : 0;
            } );

            return $lenses[ 0 ]->getOrder();
        }



        /**
         * @return int
         */
        public function getFocusingPower(): int
        {
            $res = 0;

            foreach ( $this->getLenses() as $lens )
            {
                $res += ( $this->getBoxNumber() + 1 ) * $lens->getOrder() * $lens->getFocalLength();
            }

            return $res;
        }


    }