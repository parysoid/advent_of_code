<?php

    use Base\ITask;

    class SecretEntrance implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2025/1_input.txt' );
            $dial = 50;
            $zeroCount = 0;

            foreach ( $inputText as $line )
            {
                $order = trim( $line );
                $direction = substr( $order, 0, 1 );
                $value = (int)substr( $order, 1 );

                if ( $value > 100 )
                {
                    $value = (int)substr( $order, -2 );
                }

                if ( $direction === 'L' )
                {
                    if ( $dial - $value < 0 )
                    {
                        $dial = $dial - $value + 100;
                    }
                    else
                    {
                        $dial -= $value;
                    }
                }
                else
                {
                    if ( $dial + $value > 99 )
                    {
                        $dial = 0 + ( $dial + $value - 100 );
                    }
                    else
                    {
                        $dial += $value;
                    }
                }

                if ( $dial === 0 )
                {
                    $zeroCount++;
                }
            }

            return $zeroCount;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2025/1_input.txt' );
            $dial = 50;
            $zeroCount = 0;

            foreach ( $inputText as $line )
            {
                $order = trim( $line );
                $direction = $order[ 0 ];
                $value = (int)substr( $order, 1 );

                $zerosMet = (int)ceil( $value / 100 ) - 1;
                $zeroCount += $zerosMet;

                $value = $value % 100;

                if ( $direction === 'L' )
                {
                    if ( $dial !== 0 && $dial - $value < 0 )
                    {
                        $zeroCount++;
                    }
                    $dial = ( $dial - $value + 100 ) % 100;
                }
                else
                {
                    if ( $dial !== 0 && $dial + $value > 99 && $dial + $value !== 100 )
                    {
                        $zeroCount++;
                    }
                    $dial = ( $dial + $value ) % 100;
                }

                if ( $dial === 0 )
                {
                    $zeroCount++;
                }
            }

            return $zeroCount;
        }


    }
