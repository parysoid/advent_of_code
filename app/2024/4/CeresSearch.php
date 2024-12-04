<?php

    class CeresSearch implements \Base\ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $input = file( INPUTS_PATH . '/2024/4_input.txt' );

            $sum = 0;

            for ( $y = 0; $y < count( $input ); $y++ )
            {
                for ( $x = 0; $x < strlen( $input[ $y ] ); $x++ )
                {
                    $sum += $this->countUniqueMatches( $input, $x, $y );
                }
            }

            return $sum;
        }



        /**
         * @param array $grid
         * @param int $x
         * @param int $y
         * @return int
         */
        private function countUniqueMatches( array $grid, int $x, int $y ): int
        {
            $directions = [
                [ 0, 1 ],
                [ 1, 0 ],
                [ 1, 1 ],
                [ 1, -1 ],
            ];

            $sum = 0;

            foreach ( $directions as [ $dx, $dy ] )
            {
                if (
                    $this->matchesWord( $grid, $x, $y, $dx, $dy, "XMAS" ) ||
                    $this->matchesWord( $grid, $x, $y, $dx, $dy, "SAMX" )
                )
                {
                    $sum++;
                }
            }

            return $sum;
        }



        /**
         * @param array $grid
         * @param int $x
         * @param int $y
         * @param int $dx
         * @param int $dy
         * @param string $word
         * @return bool
         */
        private function matchesWord( array $grid, int $x, int $y, int $dx, int $dy, string $word ): bool
        {
            for ( $i = 0; $i < strlen( $word ); $i++ )
            {
                $nx = $x + $i * $dx;
                $ny = $y + $i * $dy;

                if ( !isset( $grid[ $ny ][ $nx ] ) || $grid[ $ny ][ $nx ] !== $word[ $i ] )
                {
                    return false;
                }
            }

            return true;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            return 0;
        }


    }
