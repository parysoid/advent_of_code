<?php

    use App\Base\AocInput;
    use Base\ITask;

    class TrashCompactor extends AocInput implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $input = $this->readLines( 2025, 6 );
            $operations = $this->parseOperations( $input );
            $input = array_slice( $input, 0, count( $input ) - 1 );
            $res = [];

            foreach ( $input as $line )
            {
                $nums = explode( ' ', $line );

                $i = 0;
                foreach ( $nums as $num )
                {
                    if ( (int)$num === 0 )
                    {
                        continue;
                    }

                    $operation = $operations[ $i ];

                    if ( $operation === '+' )
                    {
                        $res[ $i ] = isset( $res[ $i ] ) ? $res[ $i ] + $num : $num;
                    }
                    else
                    {
                        $res[ $i ] = isset( $res[ $i ] ) ? $res[ $i ] * $num : $num;
                    }
                    $i++;
                }
            }

            return array_sum( $res );
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $input = $this->readLines( 2025, 6 );
            $sum = 0;


            return $sum;
        }



        /**
         * @param array $input
         * @return array
         */
        private function parseOperations( array $input ): array
        {
            $res = [];
            $operationsRaw = $input[ count( $input ) - 1 ];
            $operations = str_split( $operationsRaw );

            foreach ( $operations as $operation )
            {
                if ( $operation !== ' ' )
                {
                    $res[] = $operation;
                }
            }

            return $res;
        }


    }