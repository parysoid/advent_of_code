<?php

    use App\Base\AocInput;
    use Base\ITask;

    class Cafeteria extends AocInput implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $input = $this->readLines( 2025, 5 );
            $sum = 0;

            [ $ranges, $ids ] = $this->parseInput( $input );

            foreach ( $ids as $id )
            {
                foreach ( $ranges as $range )
                {
                    [ $min, $max ] = explode( '-', $range );

                    if ( $id >= (int)$min && $id <= (int)$max )
                    {
                        $sum++;
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
            $input = $this->readLines( 2025, 5 );
            $sum = 0;

            [ $ranges ] = $this->parseInput( $input );

            usort( $ranges, function ( $a, $b ) {
                [ $aFrom ] = explode( '-', $a );
                [ $bFrom ] = explode( '-', $b );
                return $aFrom - $bFrom;
            } );

            $c = 0;

            foreach ( $ranges as $range )
            {
                [ $min, $max ] = explode( '-', $range );

                if ( (int)$max > $c )
                {
                    if ( $c >= $min )
                    {
                        $min = $c + 1;
                    }

                    $freshIds = (int)$max - (int)$min + 1;
                    $sum += $freshIds;
                    $c = (int)$max;
                }
            }

            return $sum;
        }



        /**
         * @param array $input
         * @return array[]
         */
        private function parseInput( array $input ): array
        {
            $ranges = [];
            $ids = [];

            foreach ( $input as $value )
            {
                $value = trim( $value );

                if ( preg_match( '/^\d+-\d+$/', $value ) )
                {
                    $ranges[] = $value;
                }
                elseif ( filter_var( $value, FILTER_VALIDATE_INT ) !== false )
                {
                    $ids[] = $value;
                }

            }

            return [ $ranges, $ids ];
        }


    }