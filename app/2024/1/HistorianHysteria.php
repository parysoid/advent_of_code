<?php

    use Base\ITask;

    class HistorianHysteria implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2024/1_input.txt' );
            $sum = 0;

            $leftStack = [];
            $rightStack = [];

            foreach ( $inputText as $line )
            {
                $nums = explode( '   ', trim( $line ) );

                $leftStack[] = (int)$nums[ 0 ];
                $rightStack[] = (int)$nums[ 1 ];
            }

            sort( $leftStack );
            sort( $rightStack );

            foreach ( $leftStack as $key => $leftNum )
            {
                $sum += abs( $rightStack[ $key ] - $leftNum );
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