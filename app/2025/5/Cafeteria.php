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