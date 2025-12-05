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

                    for ( $j = ( $i + 1 ); $j < $batteriesCount; $j++ )
                    {
                        $numR = $batteries[ $j ];

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

            foreach ( $inputText as $line )
            {
                $batteries = str_split( $line );
                $batteriesCount = count( $batteries );
                $nums = 12;

                $res = [];
                $start = 0;

                for ( $i = 0; $i < $nums; $i++ )
                {
                    $maxDigit = 0;
                    $bestIndex = 0;
                    $max = $batteriesCount - ( $nums - $i );

                    for ( $j = $start; $j <= $max; $j++ )
                    {
                        $candidate = (int)$batteries[ $j ];

                        if ( $candidate > $maxDigit )
                        {
                            $maxDigit = $candidate;
                            $bestIndex = $j;
                        }
                    }

                    $res[] = $maxDigit;
                    $start = $bestIndex + 1;
                }

                $highest = (int)implode( '', $res );
                $sum += $highest;
            }

            return $sum;
        }



    }