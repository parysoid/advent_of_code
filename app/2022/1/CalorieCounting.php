<?php

    use Base\ITask;

    class CalorieCounting implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $inputText = file( __DIR__ . '/input.txt' );

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



        function getPartTwoResult()
        {
            // TODO: Implement getPartTwoResult() method.
        }


    }