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
            $inputText = file( INPUTS_PATH . '/2024/2_input.txt' );
            $sum = 0;

            foreach ( $inputText as $line )
            {
                $nums = explode( ' ', trim( $line ) );
                $isSafe = $this->checkNumbers( $nums );

                if ( !$isSafe )
                {
                    foreach ( $nums as $key => $num )
                    {
                        $oneNumRemoved = $nums;
                        unset( $oneNumRemoved[ $key ] );

                        $isSafeWithOneMistake = $this->checkNumbers( array_values( $oneNumRemoved ) );

                        if ( $isSafeWithOneMistake )
                        {
                            $isSafe = true;
                            break;
                        }
                    }
                }

                $sum += $isSafe === true ? 1 : 0;
            }

            return $sum;
        }



        /**
         * @param array $nums
         * @return bool
         */
        public function checkNumbers( array $nums ): bool
        {
            $lastNumber = null;
            $sortedAsc = $nums;
            $sortedDesc = $nums;

            sort( $sortedAsc, SORT_NUMERIC );
            rsort( $sortedDesc, SORT_NUMERIC );

            if ( $nums !== $sortedAsc && $nums !== $sortedDesc )
            {
                return false;
            }

            foreach ( $nums as $num )
            {
                $num = (int)$num;

                if ( $lastNumber && ( abs( $lastNumber - $num ) > 3 || abs( $lastNumber - $num ) === 0 ) )
                {
                    return false;
                }

                $lastNumber = $num;
            }

            return true;
        }


    }