<?php

    use App\Base\AocInput;
    use Base\ITask;

    class MovieTheater extends AocInput implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $res = [];
            $lines = $this->readLines( 2025, 9 );
            $n = count( $lines );

            for ( $i = 0; $i < $n; $i++ )
            {
                for ( $j = $i + 1; $j < $n; $j++ )
                {
                    [ $x1, $y1 ] = explode( ',', $lines[ $i ] );
                    [ $x2, $y2 ] = explode( ',', $lines[ $j ] );

                    if ( $y1 === $y2 )
                    {
                        $res[] = abs( (int)$x1 - (int)$x2 ) + 1;
                        continue;
                    }

                    [ $x3, $y3 ] = [ $x1, $y2 ];

                    $a = abs( (int)$y3 - (int)$y1 ) + 1;
                    $b = abs( (int)$x2 - (int)$x3 ) + 1;

                    $res[] = $a * $b;
                }
            }

            return max( $res );
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $res = 0;
            $lines = $this->readLines( 2025, 9 );

            return $res;
        }


    }