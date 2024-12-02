<?php

    use Base\ITask;

    class RedNosedReports implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2024/2_input.txt' );
            $sum = 0;

            foreach ( $inputText as $line )
            {
                $nums = explode( ' ', trim( $line ) );
                $lastNumber = null;
                $isSafe = true;

                $sortedAsc = $nums;
                $sortedDesc = $nums;

                sort( $sortedAsc );
                rsort( $sortedDesc );

                if ( $nums !== $sortedAsc && $nums !== $sortedDesc )
                {
                    continue;
                }

                foreach ( $nums as $num )
                {
                    $num = (int)$num;
                    
                    if ( $lastNumber && ( abs( $lastNumber - $num ) > 3 || abs( $lastNumber - $num ) === 0 ) )
                    {
                        $isSafe = false;
                        break;
                    }

                    $lastNumber = $num;
                }

                $sum += $isSafe === true ? 1 : 0;
            }

            return $sum;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            return 0;
        }


    }