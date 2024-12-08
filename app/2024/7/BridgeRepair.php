<?php

    class BridgeRepair implements \Base\ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $sum = 0;
            $input = file( INPUTS_PATH . '/2024/7_input.txt', FILE_IGNORE_NEW_LINES );

            //BRUTEFORCE
            foreach ( $input as $row )
            {
                $res = (int)substr( $row, 0, strpos( $row, ': ' ) );
                $numbers = explode( ' ', substr( $row, strpos( $row, ': ' ) + 2 ) );

                for ( $i = 0; $i < 100000; $i++ )
                {
                    $test = 0;

                    foreach ( $numbers as $num )
                    {
                        $test = rand( 0, 1 ) === 1 ? $test * $num : $test + $num;
                    }

                    if ( $res === $test )
                    {
                        $sum += $res;
                        break;
                    }
                }
            }

            return $sum;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $sum = 0;
            $input = file( INPUTS_PATH . '/2024/7_input.txt', FILE_IGNORE_NEW_LINES );

            foreach ( $input as $row )
            {
                $res = (int)substr( $row, 0, strpos( $row, ': ' ) );
                $numbers = explode( ' ', substr( $row, strpos( $row, ': ' ) + 2 ) );

                $isPossible = $this->testNumbers( $numbers, $res, null );

                $sum += $isPossible ? $res : 0;
            }

            return $sum;
        }



        /**
         * @param array $numbers
         * @param int $res
         * @param int|null $current
         * @return bool
         */
        private function testNumbers( array $numbers, int $res, ?int $current ): bool
        {
            if ( $current === null )
            {
                $current = array_shift( $numbers );
            }

            if ( $current > $res )
            {
                return false;
            }

            if ( empty( $numbers ) )
            {
                return $current === $res;
            }

            $next = array_shift( $numbers );

            if ( $this->testNumbers( $numbers, $res, $current + $next ) )
            {
                return true;
            }

            if ( $this->testNumbers( $numbers, $res, $current * $next ) )
            {
                return true;
            }

            if ( $this->testNumbers( $numbers, $res, (int)$current . $next ) )
            {
                return true;
            }

            return false;
        }


    }