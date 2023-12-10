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
            $input = file_get_contents( INPUTS_PATH . '/2023/5_input.txt' );

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
        public function getPartTwoResult(): int
        {
            $input = file_get_contents( INPUTS_PATH . '/2023/5_input.txt' );

            $ranges = $this->parseNumbers( $input );

            $locationNumber = 0;
            $isFound = false;

            while ( !$isFound )
            {
                $seedNumber = $this->getSeedNumberByLocationNumber( $locationNumber, $input );

                foreach ( $ranges as $range )
                {
                    $min = $range[ 0 ];
                    $max = $range[ 1 ];

                    if ( $seedNumber >= $min && $seedNumber <= $max )
                    {
                        dump( 'Result: ' . $locationNumber );
                        $isFound = true;
                    }
                }

                $locationNumber++;
            }

            return $locationNumber;
        }



        /**
         * @param string $input
         * @return array
         */
        private function parseNumbers( string $input ): array
        {
            $res = [];

            $firstRow = trim( substr( $input, strpos( $input, ' ' ) ) );
            $firstRow = substr( $firstRow, 0, strpos( $firstRow, "\r\n" ) );
            $numbers = explode( ' ', $firstRow );


            for ( $i = 0; $i <= count( $numbers ) / 2; $i += 2 )
            {
                $min = (int)$numbers[ $i ];
                $max = $min + $numbers[ $i + 1 ] - 1;

                $res[] = [ $min, $max ];
            }

            return $res;
        }



        /**
         * @param int $seedNumber
         * @param string $input
         * @return int
         */
        private function getSeedNumberByLocationNumber( int $seedNumber, string $input ): int
        {
            $maps = [ 'seed-to-soil map', 'soil-to-fertilizer map', 'fertilizer-to-water map', 'water-to-light map', 'light-to-temperature map', 'temperature-to-humidity map', 'humidity-to-location map' ];
            $maps = array_reverse( $maps );

            $destinationNumber = $seedNumber;

            foreach ( $maps as $map )
            {
                $this->searchInMapReversed( $map, $destinationNumber, $input );
            }

            return $destinationNumber;
        }



        /**
         * @param string $mapName
         * @param int $destinationNumber
         * @param string $input
         * @return void
         */
        private function searchInMapReversed( string $mapName, int &$destinationNumber, string $input )
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

                $sourceStart = (int)$numbers[ 1 ];
                $destinationStart = (int)$numbers[ 0 ];
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


    }