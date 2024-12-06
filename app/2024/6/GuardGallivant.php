<?php

    use Base\ITask;

    class GuardGallivant implements ITask
    {


        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $map = file( INPUTS_PATH . '/2024/6_input.txt', FILE_IGNORE_NEW_LINES );

            $start = $this->getStartingPosition( $map );
            $x = $start[ 'x' ];
            $y = $start[ 'y' ];
            $guard = '^';
            $isInside = true;

            while ( $isInside )
            {
                $isInside = $this->moveGuard( $map, $guard, $x, $y );
            }

            return substr_count( implode( "\r\n", $map ), 'X' );
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            return 0;
        }



        /**
         * @param array $map
         * @param string $guard
         * @param int $x
         * @param int $y
         * @return bool
         */
        private function moveGuard( array &$map, string &$guard, int &$x, int &$y ): bool
        {
            $map[ $y ][ $x ] = 'X';

            switch ( $guard )
            {
                case '^':
                    $y--;
                    break;
                case '>':
                    $x++;
                    break;
                case 'v':
                    $y++;
                    break;
                case '<':
                    $x--;
                    break;
            }

            if ( $this->isNextStepOutsideMap( $map, $x, $y ) )
            {
                return false;
            }

            if ( $this->isNextStepObstacle( $map, $x, $y ) )
            {
                $this->rotateAndMove( $guard, $x, $y );
            }

            $map[ $y ][ $x ] = $guard;

            return true;
        }



        /**
         * @param string $guard
         * @param int $x
         * @param int $y
         * @return void
         */
        private function rotateAndMove( string &$guard, int &$x, int &$y ): void
        {
            switch ( $guard )
            {
                case '^':
                    $guard = '>';
                    $y++;
                    $x++;
                    break;
                case '>':
                    $guard = 'v';
                    $y++;
                    $x--;
                    break;
                case 'v':
                    $guard = '<';
                    $y--;
                    $x--;
                    break;
                case '<':
                    $guard = '^';
                    $y--;
                    $x++;
                    break;
            }
        }



        /**
         * @param array $map
         * @return int[]
         */
        private function getStartingPosition( array $map ): array
        {
            $xCoord = 0;
            $yCoord = 0;

            foreach ( $map as $y => $row )
            {
                if ( strpos( $row, '^' ) !== false )
                {
                    $yCoord = $y;
                    $xCoord = strpos( $row, '^' );
                }
            }

            return [ 'x' => $xCoord, 'y' => $yCoord ];
        }



        /**
         * @param array $map
         * @param int $x
         * @param int $y
         * @return bool
         */
        private function isNextStepOutsideMap( array $map, int $x, int $y ): bool
        {
            return !array_key_exists( $y, $map ) || !array_key_exists( $x, str_split( $map[ $y ] ) );
        }



        /**
         * @param array $map
         * @param int $x
         * @param int $y
         * @return bool
         */
        private function isNextStepObstacle( array $map, int $x, int $y ): bool
        {
            return $map[ $y ][ $x ] === '#';
        }


    }