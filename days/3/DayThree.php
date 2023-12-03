<?php

    class DayThree implements IDay
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $rows = file( 'days/3/input.txt' );


            $sum = 0;

            foreach ( $rows as $rowId => $row )
            {
                $row = trim( $row );

                $sum += $this->parseRow( $row, $rowId, $rows );
            }

            return $sum;
        }



        /**
         * @param string $row
         * @param int $rowId
         * @param array $rows
         * @return int
         */
        private function parseRow( string $row, int $rowId, array $rows ): int
        {
            $xCoords = [];
            $numberChars = [];
            $res = 0;

            for ( $i = 0; $i < strlen( $row ); $i++ )
            {
                $char = $row[ $i ];

                if ( is_numeric( $char ) )
                {
                    $numberChars[] = $char;
                    $xCoords[] = $i;
                }

                if ( count( $numberChars ) > 0 && ( !is_numeric( $char ) || !isset( $row[ $i + 1 ] ) ) )
                {
                    $adjacentSymbols = $this->parseAdjacentSymbolChars( $rowId, $xCoords, $rows );

                    if ( count( $adjacentSymbols ) > 0 )
                    {
                        $res += (int)implode( $numberChars );
                    }

                    $numberChars = [];
                    $xCoords = [];
                }
            }

            return $res;
        }



        /**
         * @param int $y
         * @param array $xCoords
         * @param array $rows
         * @return array
         */
        private function parseAdjacentSymbolChars( int $y, array $xCoords, array $rows ): array
        {
            $res = [];
            $chars = [];
            $currentRow = trim( $rows[ $y ] );
            $prevRow = '';
            $nextRow = '';

            if ( isset( $currentRow[ min( $xCoords ) - 1 ] ) )
            {
                $leftChar = $currentRow[ min( $xCoords ) - 1 ];
                $chars[] = $leftChar;
            }

            if ( isset( $currentRow[ max( $xCoords ) + 1 ] ) )
            {
                $rightChar = $currentRow[ max( $xCoords ) + 1 ];
                $chars[] = $rightChar;
            }

            if ( isset( $rows[ $y - 1 ] ) )
            {
                $prevRow = $rows[ $y - 1 ];
                $prevRow = trim( $prevRow );
            }

            if ( isset( $rows[ $y + 1 ] ) )
            {
                $nextRow = $rows[ $y + 1 ];
                $nextRow = trim( $nextRow );
            }

            $xCoords[] = min( $xCoords ) - 1;
            $xCoords[] = max( $xCoords ) + 1;

            foreach ( $xCoords as $xCoord )
            {
                if ( $prevRow && isset( $prevRow[ $xCoord ] ) )
                {
                    $chars[] = $prevRow[ $xCoord ];
                }
                if ( $nextRow && isset( $nextRow[ $xCoord ] ) )
                {
                    $chars[] = $nextRow[ $xCoord ];
                }
            }

            foreach ( $chars as $char )
            {
                if ( $char !== '' && $char !== '.' && !is_numeric( $char ) )
                {
                    $res[] = $char;
                }
            }

            return $res;
        }



        function getPartTwoResult()
        {
            // TODO: Implement getPartTwoResult() method.
        }


    }