<?php

    use Base\ITask;

    class WaitForIt implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $res = [];
            $rows = file( __DIR__ . '/input.txt' );

            $times = array_filter( explode( ' ', str_replace( 'Time:      ', '', trim( $rows[ 0 ] ) ) ) );
            $records = array_filter( explode( ' ', str_replace( 'Distance:  ', '', $rows[ 1 ] ) ) );

            $races = array_combine( $times, $records );

            foreach ( $races as $time => $record )
            {
                $res[ $time ] = 0;

                for ( $i = 0; $i <= (int)$time; $i++ )
                {
                    $distance = $i * ( (int)$time - $i );

                    if ( $distance > (int)$record )
                    {
                        $res[ $time ]++;
                    }
                }
            }

            return array_product($res);
        }



        /**
         * @return int
         */
        public function getPartTwoResult(): int
        {
            return 0;
        }



    }