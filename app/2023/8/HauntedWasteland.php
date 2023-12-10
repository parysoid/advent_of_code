<?php

    use Base\ITask;

    class HauntedWasteland implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $elements = [];

            $rows = explode( "\r\n", file_get_contents( INPUTS_PATH . '/2023/8_input.txt' ) );
            $instructions = $rows[ 0 ];
            $rows = array_slice( $rows, 2 );

            foreach ( $rows as $row )
            {
                $el = substr( $row, 0, 3 );
                $directions = explode( ',', str_replace( [ ' ', '=', '(', ')', $el ], [ '' ], $row ) );

                $elements[ $el ] = [ 'L' => $directions[ 0 ], 'R' => $directions[ 1 ] ];
            }

            return $this->reachToEnd( $instructions, $elements );
        }



        /**
         * @param string $instructions
         * @param array $elements
         * @param string $nextElement
         * @param string $endElement
         * @return int
         */
        public function reachToEnd( string $instructions, array $elements, string $nextElement = 'AAA', string $endElement = 'ZZZ' ): int
        {
            $steps = 0;

            while ( $nextElement !== 'ZZZ' )
            {
                $instruction = $instructions[ $steps ];
                $nextElement = $elements[ $nextElement ][ $instruction ];

                $steps++;

                if ( !isset( $instructions[ $steps + 1 ] ) )
                {
                    $instructions .= $instructions;
                }
            }

            return $steps;
        }



        /**
         * @return int
         */
        public function getPartTwoResult(): int
        {
            $lines = file( INPUTS_PATH . '/2023/8_input.txt' );
            $instructions = array_shift( $lines );
            $network = [];

            foreach ( $lines as $line )
            {
                if ( $line )
                {
                    list( $node, $connections ) = explode( ' = ', $line );
                    $network[ $node ] = explode( ', ', trim( $connections, '()' ) );
                }
            }

            $startingNodes = $this->filterElementsWithEndingLetter( $network, 'A' );
            $cycleLengths = [];

            foreach ( $startingNodes as $key => $startNode )
            {
                $cycleLengths[] = $this->findCycleLength( $network, $instructions, $key );
            }

            return $this->calculateLCM( $cycleLengths );
        }



        /**
         * @param array $elements
         * @param string $letter
         * @return array
         */
        private function filterElementsWithEndingLetter( array $elements, string $letter ): array
        {
            return array_filter( $elements, function ( $el ) use ( $letter ) {
                return $el[ 2 ] === $letter ? 1 : 0;
            }, ARRAY_FILTER_USE_KEY );
        }



        /**
         * @param array $network
         * @param string $instructions
         * @param string $startNode
         * @return int
         */
        private function findCycleLength( array $network, string $instructions, string $startNode ): int
        {
            $currentNode = $startNode;
            $steps = 0;

            do
            {
                $direction = $instructions[ $steps % strlen( $instructions ) ] === 'R' ? 1 : 0;
                $currentNode = $network[ $currentNode ][ $direction ];

                $steps++;
            }
            while ( $currentNode[ 2 ] !== 'Z' );

            return $steps;
        }



        /**
         * @param array $cycleLengths
         * @return int
         */
        private function calculateLCM( array $cycleLengths ): int
        {
            $lcm = 1;
            foreach ( $cycleLengths as $length )
            {
                $lcm = $this->lcm( $lcm, $length );
            }
            return $lcm;
        }



        /**
         * @param int $a
         * @param int $b
         * @return int
         */
        function lcm( int $a, int $b ): int
        {
            return ( $a * $b ) / $this->gcd( $a, $b );
        }



        /**
         * @param int $a
         * @param int $b
         * @return int
         */
        private function gcd( int $a, int $b ): int
        {
            if ( $b == 0 )
            {
                return $a;
            }
            return $this->gcd( $b, $a % $b );
        }


    }