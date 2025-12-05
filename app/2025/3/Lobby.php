<?php

    use App\Base\AocInput;
    use Base\ITask;

    class Lobby extends AocInput implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $inputText = $this->readLines( 2025, 3 );
            $sum = 0;

            foreach ( $inputText as $line )
            {
                $batteries = str_split( $line );
                $batteriesCount = count( $batteries );
                $highest = 0;

                for ( $i = 0; $i < $batteriesCount - 1; $i++ )
                {
                    $numL = $batteries[ $i ];

                    for ( $k = ( $i + 1 ); $k < $batteriesCount; $k++ )
                    {
                        $numR = $batteries[ $k ];

                        $candidate = (int)$numL . $numR;

                        if ( $candidate > $highest )
                        {
                            $highest = $candidate;
                        }
                    }
                }

                $sum += $highest;
            }

            return $sum;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $inputText = $this->readLines( 2025, 3 );
            $sum = 0;

            return $sum;
        }



    }