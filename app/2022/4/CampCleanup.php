<?php

    use Base\ITask;

    class CampCleanup implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $lines = file( __DIR__ . '/input.txt' );

            $prioritiesSum = 0;

            foreach ( $lines as $pair )
            {
                $prioritiesSum += $this->parsePairSectorsIntersection( $pair );
            }

            return $prioritiesSum;
        }



        /**
         * @param string $pair
         * @return int
         */
        public function parsePairSectorsIntersection( string $pair ): int
        {
            $pair = trim( $pair );

            $elfSectorsRange = explode( ',', $pair );

            $firstElfSectors = range( explode( '-', $elfSectorsRange[ 0 ] )[ 0 ], explode( '-', $elfSectorsRange[ 0 ] )[ 1 ] );
            $secondElfSectors = range( explode( '-', $elfSectorsRange[ 1 ] )[ 0 ], explode( '-', $elfSectorsRange[ 1 ] )[ 1 ] );

            $intersect = array_values( array_intersect( $firstElfSectors, $secondElfSectors ) );

            if ( $intersect === $firstElfSectors || $intersect === $secondElfSectors )
            {
                return 1;
            }

            return 0;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $lines = file( __DIR__ . '/input.txt' );

            $prioritiesSum = 0;

            foreach ( $lines as $group )
            {

            }


            return $prioritiesSum;
        }



    }