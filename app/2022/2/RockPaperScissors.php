<?php

    use Base\ITask;

    class RockPaperScissors implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $lines = file( INPUTS_PATH . '/2022/2_input.txt' );

            $scoreSum = 0;

            foreach ( $lines as $round )
            {
                $scoreSum += $this->parseRoundScore( $round );
            }

            return $scoreSum;
        }



        /**
         * @param string $round
         * @return int
         */
        private function parseRoundScore( string $round ): int
        {
            $loseCombinations = [ 'A' => 'C', 'C' => 'B', 'B' => 'A', ];
            $points = [ 'A' => 1, 'B' => 2, 'C' => 3, ];

            $round = str_replace( [ 'X', 'Y', 'Z' ], [ 'A', 'B', 'C' ], $round );

            $opponent = $round[ 0 ];
            $me = $round[ 2 ];

            if ( $opponent === $me )
            {
                return 3 + $points[ $me ];
            }

            if ( $loseCombinations[ $opponent ] === $me )
            {
                return $points[ $me ];
            }
            else
            {
                return 6 + $points[ $me ];
            }
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $lines = file( INPUTS_PATH . '/2022/2_input.txt' );

            $scoreSum = 0;

            foreach ( $lines as $round )
            {
                $scoreSum += $this->parseRoundScoreV2( $round );
            }

            return $scoreSum;
        }



        /**
         * @param string $round
         * @return int
         */
        private function parseRoundScoreV2( string $round ): int
        {
            $loseCombinations = [ 'A' => 'C', 'C' => 'B', 'B' => 'A', ];
            $points = [ 'A' => 1, 'B' => 2, 'C' => 3, ];

            $opponent = $round[ 0 ];
            $result = $round[ 2 ];

            if ( $result === 'Y' )
            {
                return 3 + $points[ $opponent ];
            }

            if ( $result === 'X' )
            {
                return $points[ $loseCombinations[ $opponent ] ];
            }
            else
            {
                $winCombinations = array_flip( $loseCombinations );

                return 6 + $points[ $winCombinations[ $opponent ] ];
            }
        }


    }