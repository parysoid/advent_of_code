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

            $rows = explode( "\r\n", file_get_contents( __DIR__ . '/input.txt' ) );
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
            return 0;
        }


    }