<?php

    use App\Base\AocInput;
    use Base\ITask;

    class Laboratories extends AocInput implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $diagram = $this->readLines( 2025, 7 );
            $splittersVisited = [];

            [ $startX, $startY ] = $this->getStartCoords( $diagram );

            $this->createBeam( $diagram, $startY, $startX, $splittersVisited );

            return count( $splittersVisited );
        }



        /**
         * @param array $diagram
         * @param int $y
         * @param int $x
         * @param array $splittersVisited
         * @return void
         */
        private function createBeam( array &$diagram, int $y, int $x, array &$splittersVisited ): void
        {
            while ( isset( $diagram[ $y ][ $x ] ) )
            {
                $sector = $diagram[ $y ][ $x ];

                if ( $sector === '^' )
                {
                    if ( in_array( $y . '_' . $x, $splittersVisited ) )
                    {
                        break;
                    }

                    $splittersVisited[] = $y . '_' . $x;

                    $this->createBeam( $diagram, $y, $x + 1, $splittersVisited );
                    $this->createBeam( $diagram, $y, $x - 1, $splittersVisited );
                    break;
                }
                else
                {
                    $diagram[ $y ][ $x ] = '|';
                }

                $y++;
            }
        }



        /**
         * @param array $input
         * @return array
         */
        private function getStartCoords( array $input ): array
        {
            $startX = 0;
            $startY = 0;

            foreach ( $input as $y => $row )
            {
                $row = str_split( $row );

                foreach ( $row as $x => $char )
                {
                    if ( $char === 'S' )
                    {
                        $startX = $x;
                        $startY = $y;
                    }
                }
            }

            return [ $startX, $startY ];
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $diagram = $this->readLines( 2025, 7 );
            [ $startX, $startY ] = $this->getStartCoords( $diagram );

            $curr = array_fill( 0, strlen( $diagram[ 0 ] ), 0 );
            $curr[ $startX ] = 1;

            for ( $y = $startY; $y < count( $diagram ); $y++ )
            {
                $line = str_split( $diagram[ $y ] );

                $next = array_fill( 0, count( $line ), 0 );

                for ( $x = 0; $x < count( $line ); $x++ )
                {
                    if ( $curr[ $x ] === 0 )
                    {
                        continue;
                    }

                    if ( $line[ $x ] === 'S' || $line[ $x ] === '.' )
                    {
                        $next[ $x ] += $curr[ $x ];
                    }

                    if ( $line[ $x ] === '^' )
                    {
                        if ( isset( $line[ $x + 1 ] ) )
                        {
                            $next[ $x + 1 ] += $curr[ $x ];
                        }
                        if ( isset( $line[ $x - 1 ] ) )
                        {
                            $next[ $x - 1 ] += $curr[ $x ];
                        }
                    }
                }

                $curr = $next;
            }

            return array_sum( $curr );
        }


    }