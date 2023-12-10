<?php

    use Base\ITask;

    class Trebuchet implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2023/1_input.txt' );
            $sum = 0;

            foreach ( $inputText as $line )
            {
                $sum += $this->parseNumberFromLine( $line );
            }

            return $sum;
        }



        /**
         * @param string $line
         * @return int
         */
        private function parseNumberFromLine( string $line ): int
        {
            $temp = [];

            $numberSubstitutions = [
                [ 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', '1', '2', '3', '4', '5', '6', '7', '8', '9' ],
                [ '1', '2', '3', '4', '5', '6', '7', '8', '9', '1', '2', '3', '4', '5', '6', '7', '8', '9' ],
            ];

            $numbersLen = strlen( $line );

            for ( $i = 1; $i <= $numbersLen; $i++ )
            {
                $chunk = substr( $line, 0, $i );

                foreach ( $numberSubstitutions[ 0 ] as $key => $substitution )
                {
                    $x = strpos( $chunk, $substitution );
                    $y = strrpos( $chunk, $substitution );

                    if ( $x !== false )
                    {
                        $temp[ $x ] = $substitution;
                    }

                    if ( $y !== false )
                    {
                        $temp[ $y ] = $substitution;
                    }
                }
            }

            $res = [];

            foreach ( $temp as $num )
            {
                if ( count( $res ) === 0 )
                {
                    $res[] = str_replace( $numberSubstitutions[ 0 ], $numberSubstitutions[ 1 ], $num );
                }

                if ( !next( $temp ) )
                {
                    $res[] = str_replace( $numberSubstitutions[ 0 ], $numberSubstitutions[ 1 ], $num );
                }
            }

            return (int)$res[ 0 ] . $res[ 1 ];
        }



        /**
         * @return void
         */
        function getPartTwoResult()
        {
            // TODO: Implement getPartTwoResult() method.
        }


    }