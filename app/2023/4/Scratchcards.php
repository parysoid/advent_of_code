<?php

    use Base\ITask;

    class Scratchcards implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $rows = file( __DIR__ . '/input.txt' );

            $sum = 0;

            foreach ( $rows as $row )
            {
                $sum += $this->parseCardScoreV2( $row );
            }

            return $sum;
        }



        /**
         * @param string $row
         * @return int
         */
        private function parseCardScoreV2( string $row ): int
        {
            $row = trim( $row );
            $res = 0;

            $numbers = substr( $row, strpos( $row, ':' ) + 1 );
            $numbers = explode( '|', $numbers );

            $winningNumbers = array_filter( explode( ' ', trim( $numbers[ 0 ] ) ) );
            $myNumbers = array_filter( explode( ' ', trim( $numbers[ 1 ] ) ) );

            foreach ( $winningNumbers as $winningNumber )
            {
                if ( in_array( $winningNumber, $myNumbers, ) )
                {
                    if ( $res > 0 )
                    {
                        $res = $res * 2;
                    }
                    else
                    {
                        $res = 1;
                    }
                }
            }

            return $res;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $rows = file( __DIR__ . '/input.txt' );

            $wonCards = [];

            foreach ( $rows as $row )
            {
                $this->parseCardScoreV3( $row, $wonCards );
            }

            return array_sum($wonCards) ;
        }



        /**
         * @param string $row
         * @param array $wonCards
         * @return void
         */
        private function parseCardScoreV3( string $row, array &$wonCards ): void
        {
            $row = trim( $row );
            $cardId = trim( str_replace( 'Card', '', explode( ':', $row )[ 0 ] ) );

            if ( isset( $wonCards[ $cardId ] ) )
            {
                $wonCards[ $cardId ] += 1;
            }
            else
            {
                $wonCards[ $cardId ] = 1;
            }

            $currentCardQuantity = $wonCards[ $cardId ];

            for ( $i = 0; $i < $currentCardQuantity; $i++ )
            {
                $numbers = substr( $row, strpos( $row, ':' ) + 1 );
                $numbers = explode( '|', $numbers );

                $winningNumbers = array_filter( explode( ' ', trim( $numbers[ 0 ] ) ) );
                $myNumbers = array_filter( explode( ' ', trim( $numbers[ 1 ] ) ) );

                $nextCardId = (int)$cardId + 1;

                foreach ( $winningNumbers as $winningNumber )
                {
                    if ( in_array( $winningNumber, $myNumbers, ) )
                    {
                        if ( isset( $wonCards[ $nextCardId ] ) )
                        {
                            $wonCards[ $nextCardId ] = $wonCards[ $nextCardId ] + 1;
                        }
                        else
                        {
                            $wonCards[ $nextCardId ] = 1;
                        }
                        $nextCardId++;
                    }
                }
            }
        }


    }