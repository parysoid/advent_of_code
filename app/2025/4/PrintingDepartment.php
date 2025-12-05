<?php

    use App\Base\AocInput;
    use Base\ITask;

    class PrintingDepartment extends AocInput implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $lines = $this->readLines( 2025, 4 );
            return $this->removeRolls( $lines );
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $lines = $this->readLines( 2025, 4 );
            $sum = 0;

            do
            {
                $rollsRemoved = $this->removeRolls( $lines );
                $sum += $rollsRemoved;
            }
            while ( $rollsRemoved > 0 );

            return $sum;
        }



        /**
         * @param array $lines
         * @return int
         */
        private function removeRolls( array &$lines ): int
        {
            $sum = 0;
            $linesCount = count( $lines );
            $maxRolls = 3;
            $res = [];

            for ( $y = 0; $y < $linesCount; $y++ )
            {
                $line = str_split( $lines[ $y ] );
                $positionsCount = count( $line );

                for ( $x = 0; $x < $positionsCount; $x++ )
                {
                    $position = $lines[ $y ][ $x ];

                    if ( $position !== '@' )
                    {
                        continue;
                    }

                    $dirs = [
                        [ 1, 0 ],
                        [ 1, 1 ],
                        [ 0, 1 ],
                        [ -1, 1 ],
                        [ -1, 0 ],
                        [ -1, -1 ],
                        [ 0, -1 ],
                        [ 1, -1 ],
                    ];

                    $c = 0;

                    foreach ( $dirs as [ $dy, $dx ] )
                    {
                        $ny = $y + $dy;
                        $nx = $x + $dx;

                        if ( !isset( $lines[ $ny ] ) )
                        {
                            continue;
                        }

                        $currentLine = str_split( $lines[ $ny ] );

                        if ( isset( $currentLine[ $nx ] ) && $currentLine[ $nx ] === '@' )
                        {
                            $c++;
                        }
                    }

                    if ( $c <= $maxRolls )
                    {
                        $sum++;
                        $res[] = [ $y, $x ];
                    }
                }
            }

            foreach ( $res as [ $y, $x ] )
            {
                $lines[ $y ][ $x ] = '.';
            }

            return $sum;
        }


    }