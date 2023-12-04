<?php

    use Base\ITask;

    class Scratchcards implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $rows = file( __DIR__ . '/input.txt' );

            $sum = 0;

            foreach ( $rows as $row )
            {
                $sum += $this->parseCardScoreV2( $row );
            }

            return $sum;
        }



        /**
         * @param string $row
         * @return int
         */
        private function parseCardScoreV2( string $row ): int
        {
            $row = trim( $row );
            $res = 0;

            $numbers = substr( $row, strpos( $row, ':' ) + 1 );
            $numbers = explode( '|', $numbers );

            $winningNumbers = array_filter( explode( ' ', trim( $numbers[ 0 ] ) ) );
            $myNumbers = array_filter( explode( ' ', trim( $numbers[ 1 ] ) ) );

            foreach ( $winningNumbers as $winningNumber )
            {
                if ( in_array( $winningNumber, $myNumbers, ) )
                {
                    if ( $res > 0 )
                    {
                        $res = $res * 2;
                    }
                    else
                    {
                        $res = 1;
                    }
                }
            }

            return $res;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $rows = file( __DIR__ . '/input.txt' );

            $sum = 0;


            return $sum;
        }



    }