<?php

    use Base\ITask;

    class DiskFragmenter implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $sum = 0;
            $input = file_get_contents( INPUTS_PATH . '/2024/9_input.txt', FILE_IGNORE_NEW_LINES );

            $input = $this->parseInput( $input );
            $diskMap = $input[ 'disk_map' ];
            $max = $input[ 'max' ];

            $id = 0;
            $c = 0;

            for ( $i = 0; $i < count( $diskMap ); $i++ )
            {
                for ( $k = 0; $k < count( $diskMap[ $i ] ); $k++ )
                {
                    if ( $c === $max )
                    {
                        break;
                    }

                    $p = $i;

                    if ( $diskMap[ $i ][ $k ] === '.' )
                    {
                        $lastNumber = $this->getLastNumberFromDiskMap( $diskMap );
                        $diskMap[ $i ][ $k ] = $diskMap[ $lastNumber[ 'i' ] ][ $lastNumber[ 'k' ] ];


                        $diskMap[ $lastNumber[ 'i' ] ][ $lastNumber[ 'k' ] ] = '.';

                        $p = $lastNumber[ 'i' ];
                    }

                    $sum += $id * $p;

                    $id++;
                    $c++;
                }

            }

            return $sum;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            return 0;
        }



        /**
         * @param string $input
         * @return array
         */
        private function parseInput( string $input ): array
        {
            $diskMap = [];
            $max = 0;

            $input = str_split( $input, 2 );

            foreach ( $input as $id => $block )
            {
                $max += $block[ 0 ];
                $x = array_fill( 0, $block[ 0 ], $id );
                $y = isset( $block[ 1 ] ) ? array_fill( $block[ 0 ], $block[ 1 ], '.' ) : [];

                $diskMap[] = $x + $y;
            }

            return [ 'disk_map' => $diskMap, 'max' => $max ];
        }



        /**
         * @param array $diskMap
         * @return array
         */
        private function getLastNumberFromDiskMap( array $diskMap ): array
        {
            $i = array_key_last( $diskMap );
            $k = array_key_last( $diskMap[ $i ] );
            $lastChar = $diskMap[ $i ][ $k ];

            if ( $lastChar !== '.' )
            {
                return [ 'i' => $i, 'k' => $k ];
            }

            while ( $diskMap[ $i ][ $k ] === '.' )
            {
                if ( isset( $diskMap[ $i ][ $k - 1 ] ) )
                {
                    $k--;
                }
                else
                {
                    $i--;
                    $k = array_key_last( $diskMap[ $i ] );
                }
            }

            return [ 'i' => $i, 'k' => $k ];
        }



        /**
         * @param array $diskMap
         * @return string
         */
        private function connectToString( array $diskMap ): string
        {
            $res = '';
            foreach ( $diskMap as $slot )
            {
                $res .= implode( $slot );
            }
            return $res;
        }



    }