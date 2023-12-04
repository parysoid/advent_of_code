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
         * @return int
         */
        private function parseStartOfPacketMarker( string $input ): int
        {
            for ( $i = 0; $i < strlen( $input ); $i++ )
            {
                $chunk = substr( $input, $i, 4 );

                if ( count( array_unique( str_split( $chunk ) ) ) === 4 )
                {
                    return $i + 4;
                }
            }

            return 0;
        }



        /**
         * @return string
         */
        public function getPartTwoResult(): string
        {
            return '';
        }



    }