<?php

    use Base\ITask;

    class CalorieCounting implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2022/1_input.txt' );

            $elfInventories = $this->parseCaloriesSumForEachElf( $inputText );

            return max( $elfInventories );
        }



        /**
         * @param array $caloriesList
         * @return array
         */
        private function parseCaloriesSumForEachElf( array $caloriesList ): array
        {
            $res = [];
            $caloriesList[] = "\r\n";
            $currentElfId = 0;
            $currentElfIdSum = 0;

            foreach ( $caloriesList as $calorieRecord )
            {
                if ( $calorieRecord === "\r\n" )
                {
                    $res[ $currentElfId ] = $currentElfIdSum;
                    $currentElfId++;
                    $currentElfIdSum = 0;
                }
                else
                {
                    $currentElfIdSum += (int)$calorieRecord;
                }
            }

            return $res;
        }



        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $inputText = file( INPUTS_PATH . '/2022/1_input.txt' );

            $elfInventories = $this->parseCaloriesSumForEachElf( $inputText );

            arsort( $elfInventories, SORT_ASC );

            return array_sum( array_slice( $elfInventories, 0, 3 ) );
        }


    }