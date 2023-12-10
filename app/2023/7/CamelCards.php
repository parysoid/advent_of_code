<?php

    use Base\ITask;

    class CamelCards implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $res = [];
            $handsParsed = [];

            $hands = file( INPUTS_PATH . '/2023/7_input.txt' );

            foreach ( $hands as $hand )
            {
                $cardsInHand = explode( ' ', $hand )[ 0 ];
                $bid = (int)explode( ' ', $hand )[ 1 ];

                $handsParsed[ $hand ] = [
                    'strength' => $this->getHandStrength( $cardsInHand ),
                    'cards' => $cardsInHand,
                    'bid' => $bid
                ];
            }

            usort( $handsParsed, 'compareTwoHandsStrength' );

            foreach ( $handsParsed as $key => $handParsed )
            {
                $res[] = ( $key + 1 ) * $handParsed[ 'bid' ];
            }

            return array_sum( $res );
        }



        /**
         * @param string $hand
         * @return int
         */
        private function getHandStrength( string $hand ): int
        {
            $cardValues = [ 'A' => 14, 'K' => 13, 'Q' => 12, 'J' => 11, 'T' => 10, '9' => 9, '8' => 8, '7' => 7, '6' => 6, '5' => 5, '4' => 4, '3' => 3, '2' => 2 ];

            $strength = 0;
            $highCardValue = 0;

            foreach ( $cardValues as $card => $value )
            {
                $cardCount = substr_count( $hand, $card );

                if ( $cardCount === 5 )
                {
                    //Five of a kind - 700
                    $strength = 700;
                    break;
                }

                if ( $cardCount === 4 )
                {
                    //Four of a kind - 600
                    $strength = 600;
                    break;
                }

                if ( $cardCount === 3 )
                {
                    if ( $strength === 200 )
                    {
                        //Full house - 3&2 - 500
                        $strength += 300;
                    }
                    else
                    {
                        //Three of a kind - 400
                        $strength = 400;
                    }
                }

                //One pair - 200
                if ( $cardCount === 2 )
                {
                    if ( $strength === 400 )
                    {
                        //Full house - 3&2 - 500
                        $strength += 100;
                    }
                    elseif ( $strength === 200 )
                    {
                        $strength += 100;
                    }
                    else
                    {
                        $strength = 200;
                    }
                }

                //High card - 100 + value
                if ( $cardCount === 1 && $value > $highCardValue )
                {
                    $highCardValue = 100;
                }
            }

            if ( $strength === 0 )
            {
                $strength = $highCardValue;
            }


            return $strength;
        }



        /**
         * @return int
         */
        public function getPartTwoResult(): int
        {
            $res = [];
            $handsParsed = [];

            $hands = file( INPUTS_PATH . '/2023/7_input.txt' );

            foreach ( $hands as $hand )
            {
                $cardsInHand = explode( ' ', $hand )[ 0 ];
                $bid = (int)explode( ' ', $hand )[ 1 ];

                $handsParsed[ $hand ] = [
                    'strength' => $this->getHandStrengthPartTwo( $cardsInHand ),
                    'cards' => $cardsInHand,
                    'bid' => $bid
                ];
            }

            usort( $handsParsed, 'compareTwoHandsStrengthPartTwo' );

            foreach ( $handsParsed as $key => $handParsed )
            {
                $res[] = ( $key + 1 ) * $handParsed[ 'bid' ];
            }

            return array_sum( $res );
        }



        /**
         * @param string $hand
         * @return int
         */
        private function getHandStrengthPartTwo( string $hand ): int
        {
            $cardValues = [ 'A' => 13, 'K' => 12, 'Q' => 11, 'T' => 10, '9' => 9, '8' => 8, '7' => 7, '6' => 6, '5' => 5, '4' => 4, '3' => 3, '2' => 2, 'J' => 1 ];
            $combos = [ '5' => 700, '41' => 600, '32' => 500, '311' => 400, '221' => 300, '2111' => 200, '11111' => 100 ];

            $strengths = [];
            $cases = [];

            if ( strpos( $hand, 'J' ) === false )
            {
                $cases[] = $hand;
            }
            else
            {
                foreach ( $cardValues as $card => $value )
                {
                    $cases[] = str_replace( 'J', $card, $hand );
                }
            }

            foreach ( $cases as $case )
            {
                $cardsCount = array_count_values( str_split( $case ) );

                rsort( $cardsCount );

                $handPaired = implode( '', $cardsCount );

                $strengths[] = $combos[ $handPaired ];
            }

            return max( $strengths );
        }


    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    function compareTwoHandsStrength( $a, $b ): int
    {
        if ( $a[ 'strength' ] === $b[ 'strength' ] )
        {
            return compareTwoHandsHighCards( $a, $b );
        }

        return $a[ 'strength' ] > $b[ 'strength' ] ? 1 : 0;
    }



    /**
     * @param $a
     * @param $b
     * @return int
     */
    function compareTwoHandsHighCards( $a, $b ): int
    {
        $cardValues = [ 'A' => 14, 'K' => 13, 'Q' => 12, 'J' => 11, 'T' => 10, '9' => 9, '8' => 8, '7' => 7, '6' => 6, '5' => 5, '4' => 4, '3' => 3, '2' => 2 ];

        for ( $i = 0; $i < strlen( $a[ 'cards' ] ); $i++ )
        {
            $currentCardLeft = $a[ 'cards' ][ $i ];
            $currentCardRight = $b[ 'cards' ][ $i ];

            if ( $currentCardLeft !== $currentCardRight )
            {
                return $cardValues[ $currentCardLeft ] > $cardValues[ $currentCardRight ] ? 1 : 0;
            }
        }

        return 0;
    }



    /**
     * @param $a
     * @param $b
     * @return int
     */
    function compareTwoHandsStrengthPartTwo( $a, $b ): int
    {
        if ( $a[ 'strength' ] === $b[ 'strength' ] )
        {
            return compareTwoHandsHighCardsPartTwo( $a, $b );
        }

        return $a[ 'strength' ] > $b[ 'strength' ] ? 1 : 0;
    }



    /**
     * @param $a
     * @param $b
     * @return int
     */
    function compareTwoHandsHighCardsPartTwo( $a, $b ): int
    {
        $cardValues = [ 'A' => 13, 'K' => 12, 'Q' => 11, 'T' => 10, '9' => 9, '8' => 8, '7' => 7, '6' => 6, '5' => 5, '4' => 4, '3' => 3, '2' => 2, 'J' => 1 ];

        for ( $i = 0; $i < strlen( $a[ 'cards' ] ); $i++ )
        {
            $currentCardLeft = $a[ 'cards' ][ $i ];
            $currentCardRight = $b[ 'cards' ][ $i ];

            if ( $currentCardLeft !== $currentCardRight )
            {
                return $cardValues[ $currentCardLeft ] > $cardValues[ $currentCardRight ] ? 1 : 0;
            }
        }

        return 0;
    }