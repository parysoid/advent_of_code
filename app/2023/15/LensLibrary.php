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
                $sum += $this->processStep( $step );
            }

            return $sum;
        }



        private function processStep( string $step ): int
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
            return 0;
        }


    }