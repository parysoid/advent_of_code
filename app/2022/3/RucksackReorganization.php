<?php

    use Base\ITask;

    class RucksackReorganization implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $lines = file( INPUTS_PATH . '/2022/3_input.txt' );

            $prioritiesSum = 0;

            foreach ( $lines as $rucksack )
            {
                $prioritiesSum += $this->parseItemPriority( $rucksack );
            }

            return $prioritiesSum;
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



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $lines = file( INPUTS_PATH . '/2022/3_input.txt' );

            $prioritiesSum = 0;

            $lines = array_chunk( $lines, 3 );

            foreach ( $lines as $group )
            {
                $prioritiesSum += $this->parseGroupBadges( $group );
            }


            return $prioritiesSum;
        }



        /**
         * @param array $group
         * @return int
         */
        private function parseGroupBadges( array $group ): int
        {
            $itemChars = array_merge( range( 'a', 'z' ), range( 'A', 'Z' ) );
            $priorityValues = range( 1, 52 );
            $priorities = array_combine( $itemChars, $priorityValues );


            for ( $i = 0; $i < strlen( $group[ 0 ] ); $i++ )
            {
                $itemChar = $group[ 0 ][ $i ];

                if ( strpos( $group[ 1 ], $itemChar ) !== false && strpos( $group[ 2 ], $itemChar ) !== false )
                {
                    return $priorities[ $itemChar ];
                }
            }

            return 0;
        }


    }