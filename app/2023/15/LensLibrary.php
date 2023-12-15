<?php

    use Base\ITask;

    class LensLibrary implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $steps = explode( ',', file_get_contents( INPUTS_PATH . '/2023/15_input.txt' ) );

            $sum = 0;

            foreach ( $steps as $step )
            {
                $sum += $this->processHash( $step );
            }

            return $sum;
        }



        /**
         * @param string $step
         * @return int
         */
        private function processHash( string $step ): int
        {
            $res = 0;

            for ( $i = 0; $i < strlen( $step ); $i++ )
            {
                $char = $step[ $i ];

                $res += ord( $char );
                $res *= 17;
                $res = $res % 256;
            }

            return $res;
        }



        /**
         * @return int
         */
        public function getPartTwoResult(): int
        {
            $steps = explode( ',', file_get_contents( INPUTS_PATH . '/2023/15_input.txt' ) );

            $boxes = new Boxes();

            foreach ( $steps as $step )
            {
                $this->processHashmap( $step, $boxes );
            }

            return $boxes->getFocusingPower();
        }



        /**
         * @param string $step
         * @param Boxes $boxes
         * @return void
         */
        private function processHashmap( string $step, Boxes $boxes ): void
        {
            $operation = strpos( $step, '-' ) !== false ? 'DASH' : 'EQUALS_SIGN';

            $step = explode( ';', str_replace( [ '=', '-' ], [ ';' ], $step ) );
            $label = $step[ 0 ];
            $boxNumber = $this->processHash( $label );

            if ( $operation === 'EQUALS_SIGN' )
            {
                $focalLength = (int)$step[ 1 ];

                $boxes->attachLens( $boxNumber, $label, $focalLength );
            }
            else
            {
                $boxes->removeLens( $boxNumber, $label );
            }
        }


    }