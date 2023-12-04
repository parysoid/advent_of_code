<?php

    use Base\ITask;

    class TuningTrouble implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $input = trim( file_get_contents( __DIR__ . '/input.txt' ) );

            return $this->parseStartOfPacketMarker( $input );
        }



        /**
         * @param string $input
         * @param int $markerDistinctChars
         * @return int
         */
        private function parseStartOfPacketMarker( string $input, int $markerDistinctChars = 4 ): int
        {
            for ( $i = 0; $i < strlen( $input ); $i++ )
            {
                $chunk = substr( $input, $i, $markerDistinctChars );

                if ( count( array_unique( str_split( $chunk ) ) ) === $markerDistinctChars )
                {
                    return $i + $markerDistinctChars;
                }
            }

            return 0;
        }



        /**
         * @return string
         */
        public function getPartTwoResult(): string
        {
            $input = trim( file_get_contents( __DIR__ . '/input.txt' ) );

            return $this->parseStartOfPacketMarker( $input, 14 );
        }



    }