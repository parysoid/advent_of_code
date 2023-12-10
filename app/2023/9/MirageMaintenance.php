<?php

    use Base\ITask;

    class MirageMaintenance implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $sum = 0;
            $sequences = file( __DIR__ . '/input.txt' );

            foreach ( $sequences as $sequence )
            {
                $sequence = explode( ' ', str_replace( "\r\n", '', $sequence ) );
                $sequence = array_map( function ( $n ) {
                    return (int)$n;
                }, $sequence );

                $sum += $this->predictNextValue( $sequence );

            }

            return $sum;
        }



        private function predictNextValue( array $sequence ): int
        {
            $rows = [ $sequence ];

            do
            {
                $row = [];

                for ( $i = 0; $i < count( $sequence ) - 1; $i++ )
                {
                    $row[] = $sequence[ $i + 1 ] - $sequence[ $i ];
                }

                $rows[] = $row;
                $sequence = $row;
            }
            while ( count( array_unique( $row ) ) !== 1 );


            for ( $i = count( $rows ) - 1; $i > 0; $i-- )
            {
                $row = $rows[ $i ];
                $rowNext = $rows[ $i - 1 ];

                $numA = $row[ count( $row ) - 1 ];
                $numB = $rowNext[ count( $rowNext ) - 1 ];

                $rows[ $i - 1 ][] = $numA + $numB;
            }

            return end( $rows[ 0 ] );
        }



        /**
         * @return int
         */
        public function getPartTwoResult(): int
        {
            return 0;
        }


    }