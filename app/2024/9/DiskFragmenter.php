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
            $sum = 0;
            $input = file_get_contents( INPUTS_PATH . '/2024/9_input.txt', FILE_IGNORE_NEW_LINES );

            $input = $this->parseInputV2( $input );
            $diskMap = $input[ 'disk_map' ];
            $emptySlots = $input[ 'empty_slots' ];
            $res = [];

            for ( $i = count( $diskMap ) - 1; $i >= 0; $i-- )
            {
                $chunkLen = count( $diskMap[ $i ] );
                $freeSlot = $this->getFirstAvailableSlot( $emptySlots, $chunkLen, $i );

                $slot = array_fill( 0, $chunkLen, $i );

                if ( $freeSlot !== null )
                {
                    $res[ $freeSlot ] = array_merge( isset( $res[ $freeSlot ] ) ? array_values( $res[ $freeSlot ] ) : [], $slot );
                    $res[ $i ] = array_merge( array_fill( 0, $chunkLen, 0 ), isset( $res[ $i ] ) ? array_values( $res[ $i ] ) : [] );
                }
                else
                {
                    $res[ $i ] = array_merge( $slot, isset( $res[ $i ] ) ? array_values( $res[ $i ] ) : [] );
                }
            }

            foreach ( $emptySlots as $key => $e )
            {
                $res[ $key ] = array_merge( isset( $res[ $key ] ) ? array_values( $res[ $key ] ) : [], array_fill( 0, $e, 0 ) );
            }

            ksort( $res );

            $p = 0;
            foreach ( $res as $slot )
            {
                foreach ( $slot as $id )
                {
                    $sum += $p * $id;
                    $p++;
                }
            }

            return $sum;
        }



        /**
         * @param array $freeSlots
         * @param int $chunkLen
         * @param int $id
         * @return int|null
         */
        private function getFirstAvailableSlot( array &$freeSlots, int $chunkLen, int $id ): ?int
        {
            $freeSlotsTmp = array_filter( $freeSlots, function ( $v, $k ) use ( $id ) {
                return $k < $id;
            }, ARRAY_FILTER_USE_BOTH );

            foreach ( $freeSlotsTmp as $key => $freeSlotSpace )
            {
                if ( $freeSlotSpace >= $chunkLen )
                {
                    $freeSlots[ $key ] = $freeSlotSpace - $chunkLen;
                    return $key;
                }
            }

            return null;
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
         * @param string $input
         * @return array
         */
        private function parseInputV2( string $input ): array
        {
            $diskMap = [];
            $emptySlots = [];
            $max = 0;

            $input = str_split( $input, 2 );

            foreach ( $input as $id => $block )
            {
                $diskMap[] = array_fill( 0, $block[ 0 ], $id );

                if ( isset( $block[ 1 ] ) && $block[ 1 ] != 0 )
                {
                    $emptySlots[ $id ] = (int)$block[ 1 ];
                }
            }

            return [ 'disk_map' => $diskMap, 'max' => $max, 'empty_slots' => $emptySlots ];
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