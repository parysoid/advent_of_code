<?php

    use Base\ITask;

    class CubeConundrum implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2023/2_input.txt' );
            $sum = 0;

            foreach ( $inputText as $line )
            {
                $gameId = $this->parseGameId( $line );
                $gamePossible = $this->checkIfGamePossibleV3( $line );

                if ( $gamePossible )
                {
                    $sum += $gameId;
                }
            }

            return $sum;
        }



        /**
         * @param string $line
         * @return int
         */
        private function parseGameId( string $line ): int
        {
            $gameSection = explode( ':', $line );

            return explode( ' ', implode( '', $gameSection ) )[ 1 ];
        }



        /**
         * @param string $line
         * @return bool
         */
        private function checkIfGamePossibleV3( string $line ): bool
        {
            $line = trim( $line );

            $max = [
                'blue' => 14,
                'red' => 12,
                'green' => 13,
            ];

            $line = substr( $line, strpos( $line, ':' ) + 2 );
            $line = str_replace( ';', ',', $line );


            $cubes = explode( ',', $line );

            foreach ( $cubes as $cube )
            {
                $values = explode( ' ', trim( $cube ) );

                $quantity = $values[ 0 ];
                $color = $values[ 1 ];

                if ( $quantity > $max[ $color ] )
                {
                    return false;
                }

            }

            return true;
        }



        /**
         * @return int
         */
        public function getPartTwoResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2023/2_input.txt' );
            $sum = 0;

            foreach ( $inputText as $line )
            {
                $sum += $this->getSumOfFewestCubesPossible( $line );
            }

            return $sum;
        }



        /**
         * @param string $line
         * @return int
         */
        private function getSumOfFewestCubesPossible( string $line ): int
        {
            $line = trim( $line );

            $max = [
                'blue' => 0,
                'red' => 0,
                'green' => 0,
            ];

            $line = substr( $line, strpos( $line, ':' ) + 2 );
            $line = str_replace( ';', ',', $line );

            $cubes = explode( ',', $line );

            foreach ( $cubes as $cube )
            {
                $values = explode( ' ', trim( $cube ) );

                $quantity = $values[ 0 ];
                $color = $values[ 1 ];

                if ( $quantity > $max[ $color ] )
                {
                    $max[ $color ] = $quantity;
                }

            }

            return $max[ 'blue' ] * $max[ 'red' ] * $max[ 'green' ];
        }


    }