<?php

    use Base\ITask;

    class RucksackReorganization implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $lines = file( __DIR__ . '/input.txt' );

            $prioritiesSum = 0;

            foreach ( $lines as $rucksack )
            {
                $prioritiesSum += $this->parseItemPriority( $rucksack );
            }

            return $prioritiesSum;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $lines = file( __DIR__ . '/input.txt' );

            $scoreSum = 0;


            return $scoreSum;
        }



        /**
         * @param string $rucksack
         * @return int
         */
        private function parseItemPriority( string $rucksack ): int
        {
            $rucksack = trim( ( $rucksack ) );

            $itemChars = array_merge( range( 'a', 'z' ), range( 'A', 'Z' ) );
            $priorityValues = range( 1, 52 );
            $priorities = array_combine( $itemChars, $priorityValues );

            $leftCompartment = substr( $rucksack, 0, strlen( $rucksack ) / 2 );
            $rightCompartment = substr( $rucksack, strlen( $rucksack ) / 2 );

            for ( $i = 0; $i < strlen( $leftCompartment ); $i++ )
            {
                $itemChar = $leftCompartment[ $i ];

                if ( strpos( $rightCompartment, $itemChar ) !== false )
                {
                    return $priorities[ $itemChar ];

                }
            }

            return 0;
        }


    }