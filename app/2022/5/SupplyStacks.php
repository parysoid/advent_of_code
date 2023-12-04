<?php

    use Base\ITask;

    class SupplyStacks implements ITask
    {

        /**
         * @return string
         */
        public function getPartOneResult(): string
        {
            $lines = file_get_contents( __DIR__ . '/input.txt' );
            $lines = str_replace( '     ', ' [ ] ', $lines );
            $lines = str_replace( '     ', ' [ ] ', $lines );
            $lines = explode( "\r\n", $lines );

            $topFloor = [];
            $schema = [];

            $this->parseSchemaToMultiArray( $lines, $schema );
            $this->processProcedureSteps( $lines, $schema );

            foreach ( $schema as $col )
            {
                if ( isset( $col[ 0 ] ) )
                {
                    $topFloor[] = $col[ 0 ];
                }
            }

            return implode( '', $topFloor );
        }



        /**
         * @param array $lines
         * @param array $cols
         * @return void
         */
        private function parseSchemaToMultiArray( array &$lines, array &$cols ): void
        {
            $alphabet = range( 'A', 'Z' );

            foreach ( $lines as $key => $line )
            {
                if ( $line === '' )
                {
                    unset( $lines[ $key ] );
                    break;
                }

                for ( $i = 0; $i < strlen( $line ); $i++ )
                {
                    $char = $line[ $i ];

                    if ( in_array( strtoupper( $char ), $alphabet ) )
                    {
                        $cols[ $i ][] = $char;
                    }
                }
                unset( $lines[ $key ] );
            }

            ksort( $cols );

            $keys = range( 1, count( $cols ) );
            $cols = array_combine( $keys, $cols );
        }



        /**
         * @param array $steps
         * @param array $cols
         * @return void
         */
        private function processProcedureSteps( array $steps, array &$cols ): void
        {
            foreach ( $steps as $step )
            {
                $step = explode( ' ', str_replace( [ 'move ', 'from ', 'to ' ], [ '', '', '' ], $step ) );

                $quantity = (int)$step[ 0 ];
                $from = (int)$step[ 1 ];
                $to = (int)$step[ 2 ];

                for ( $i = 0; $i < $quantity; $i++ )
                {
                    $this->processCraneMovement( $cols, $from, $to );
                }
            }
        }



        /**
         * @param array $cols
         * @param int $from
         * @param int $to
         * @return void
         */
        private function processCraneMovement( array &$cols, int $from, int $to ): void
        {
            $crate = array_shift( $cols[ $from ] );
            $stackLen = array_unshift( $cols[ $to ], $crate );
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $lines = file( __DIR__ . '/input.txt' );

            $count = 0;

            foreach ( $lines as $pair )
            {
                $count += $this->parsePairSectorsOverlap( $pair );
            }

            return $count;
        }



    }