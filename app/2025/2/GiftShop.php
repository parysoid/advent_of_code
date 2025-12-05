<?php

    use Base\ITask;

    class GiftShop implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $idRanges = explode( ',', file_get_contents( INPUTS_PATH . '/2025/2_input.txt' ) );
            $sum = 0;

            foreach ( $idRanges as $idRange )
            {
                $idRange = explode( '-', $idRange );

                $min = $idRange[ 0 ];
                $max = $idRange[ 1 ];

                for ( $i = $min; $i <= $max; $i++ )
                {
                    $num = str_split( (string)$i );

                    if ( strlen( (string)$i ) % 2 !== 0 )
                    {
                        continue;
                    }

                    if ( count( array_unique( $num ) ) === 1 )
                    {
                        $sum += $i;
                        continue;
                    }

                    $numMirroring = array_chunk( $num, count( $num ) / 2 );

                    if ( $numMirroring[ 0 ] === $numMirroring[ 1 ] )
                    {
                        $sum += $i;
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
            $idRanges = explode( ',', file_get_contents( INPUTS_PATH . '/2025/2_input.txt' ) );
            $sum = 0;

            foreach ( $idRanges as $idRange )
            {
                $idRange = explode( '-', $idRange );

                $min = $idRange[ 0 ];
                $max = $idRange[ 1 ];

                for ( $i = $min; $i <= $max; $i++ )
                {
                    $str = (string)$i;
                    $len = strlen( $str );

                    if ( $len === 1 )
                    {
                        continue;
                    }

                    $num = str_split( (string)$i );

                    if ( count( array_unique( $num ) ) === 1 )
                    {
                        $sum += $i;
                        continue;
                    }

                    $chunks = (int)floor( count( $num ) / 2 );

                    for ( $k = 2; $k <= $chunks; $k++ )
                    {
                        $numMirroring = array_chunk( $num, $k );

                        if ( count( array_unique( $numMirroring, SORT_REGULAR ) ) === 1 )
                        {
                            $sum += $i;
                            break;
                        }
                    }
                }
            }

            return $sum;
        }



    }