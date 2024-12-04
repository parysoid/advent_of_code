<?php

    use Base\ITask;

    class NullItOver implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2024/3_input.txt' );
            $sum = 0;

            foreach ( $inputText as $line )
            {
                preg_match_all( '/\bmul\(([1-9][0-9]{0,2}),([1-9][0-9]{0,2})\)/', $line, $matches );

                foreach ( $matches[ 0 ] as $key => $match )
                {
                    $numA = (int)$matches[ 1 ][ $key ];
                    $numB = (int)$matches[ 2 ][ $key ];

                    $sum += $numA * $numB;
                }
            }

            return $sum;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $inputText = trim( file_get_contents( INPUTS_PATH . '/2024/3_input.txt' ) );
            $sum = 0;

            $inputText = preg_replace('/don\'t\(\)(?:.|\n)*?do\(\)/', '', $inputText);

            $sum += $this->getLineSum( $inputText );

            return $sum;
        }



        /**
         * @param string $line
         * @return int
         */
        public function getLineSum( string $line ): int
        {
            $sum = 0;

            preg_match_all( '/\bmul\(([1-9][0-9]{0,2}),([1-9][0-9]{0,2})\)/', $line, $matches );

            foreach ( $matches[ 0 ] as $key => $match )
            {
                $numA = (int)$matches[ 1 ][ $key ];
                $numB = (int)$matches[ 2 ][ $key ];

                $sum += $numA * $numB;
            }

            return $sum;
        }


    }