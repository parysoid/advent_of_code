<?php

    class PrintQueue implements \Base\ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $sum = 0;

            $rules = $this->parseRules();
            $updates = $this->parseUpdates();

            foreach ( $updates as $update )
            {
                $isValid = $this->validateUpdate( $rules, $update );

                $sum += $isValid ? (int)$update[ (int)count( $update ) / 2 ] : 0;
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



        /**
         * @param array $rules
         * @param array $update
         * @return bool
         */
        private function validateUpdate( array $rules, array $update ): bool
        {
            for ( $i = count( $update ) - 1; $i > 0; $i-- )
            {
                $num = $update[ $i ];

                $siblings = array_slice( $update, 0, $i );

                if ( array_key_exists( $num, $rules ) )
                {
                    foreach ( $siblings as $prevSibling )
                    {
                        if ( in_array( $prevSibling, $rules[ $num ], true ) )
                        {
                            return false;
                        }
                    }
                }
            }

            return true;
        }



        /**
         * @return array
         */
        private function parseRules(): array
        {
            $res = [];

            $input = file_get_contents( INPUTS_PATH . '/2024/5_input.txt' );
            $input = str_replace( "\r\n", ';', $input );
            $input = explode( ';', $input );

            $separator = array_search( '', $input );

            $rulesTmp = array_slice( $input, 0, $separator );

            foreach ( $rulesTmp as $rule )
            {
                $values = explode( '|', $rule );

                if ( !array_key_exists( $values[ 0 ], $res ) )
                {
                    $res[ $values[ 0 ] ] = [];
                }

                $res[ $values[ 0 ] ][] = $values[ 1 ];
            }

            return $res;
        }



        /**
         * @return array
         */
        private function parseUpdates(): array
        {
            $res = [];
            $input = file_get_contents( INPUTS_PATH . '/2024/5_input.txt' );

            $input = str_replace( "\r\n", ';', $input );
            $input = explode( ';', $input );

            $separator = array_search( '', $input );

            $updatesTmp = array_slice( $input, $separator + 1 );

            foreach ( $updatesTmp as $update )
            {
                $res[] = explode( ',', $update );
            }

            return $res;
        }


    }