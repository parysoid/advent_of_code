<?php

    use Base\ITask;

    class IfYouGiveASeedAFertilizer implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $res = [];
            $input = file_get_contents( __DIR__ . '/input.txt' );

            $firstRow = trim( substr( $input, strpos( $input, ' ' ) ) );
            $firstRow = substr( $firstRow, 0, strpos( $firstRow, "\r\n" ) );
            $numbers = explode( ' ', $firstRow );

            foreach ( $numbers as $number )
            {
                $res[] = $this->getLocationNumberBySeedNumber( $number, $input );
            }

            return min( $res );
        }



        /**
         * @param int $seedNumber
         * @param string $input
         * @return int
         */
        private function getLocationNumberBySeedNumber( int $seedNumber, string $input ): int
        {
            $maps = [ 'seed-to-soil map', 'soil-to-fertilizer map', 'fertilizer-to-water map', 'water-to-light map', 'light-to-temperature map', 'temperature-to-humidity map', 'humidity-to-location map' ];

            $destinationNumber = $seedNumber;

            foreach ( $maps as $map )
            {
                $this->searchInMap( $map, $destinationNumber, $input );
            }

            return $destinationNumber;
        }



        /**
         * @param string $mapName
         * @param int $destinationNumber
         * @param string $input
         * @return void
         */
        private function searchInMap( string $mapName, int &$destinationNumber, string $input )
        {
            $input = $input . "\r\n\r\n";
            $start = strpos( $input, $mapName . ':' );
            $input = substr( $input, $start );
            $input = substr( $input, 0, strpos( $input, "\r\n\r\n" ) );
            $input = substr( $input, strpos( $input, "\r\n" ) + 2 );

            $mapRows = explode( "\r\n", $input );

            foreach ( $mapRows as $mapRow )
            {
                $numbers = explode( ' ', $mapRow );

                $sourceStart = (int)$numbers[ 0 ];
                $destinationStart = (int)$numbers[ 1 ];
                $range = (int)$numbers[ 2 ];

                $destinationEnd = $destinationStart + ( $range - 1 );
                $sourceEnd = $sourceStart + ( $range - 1 );

                if ( $destinationNumber >= $destinationStart && $destinationNumber <= $destinationEnd )
                {
                    $x = $destinationNumber - $destinationStart;
                    $destinationNumber = $sourceStart + $x;

                    break;
                }
            }
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $rows = file( __DIR__ . '/input.txt' );

            $wonCards = [];


            return array_sum( $wonCards );
        }



    }