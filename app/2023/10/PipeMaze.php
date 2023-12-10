<?php

    use Base\ITask;

    class PipeMaze implements ITask
    {

        /**
         * @return int
         */
        public function getPartOneResult(): int
        {
            $maze = file( INPUTS_PATH . '/2023/10_input.txt', FILE_IGNORE_NEW_LINES );

            dump( file_get_contents( INPUTS_PATH . '/2023/10_input.txt' ) );

            $animalPos = $this->getAnimalPosition();
            $steps = 1;

            $nextStep = [
                'x' => $animalPos[ 'x' ] + 1,
                'y' => $animalPos[ 'y' ],
                'last_movement' => 'left_to_right',
                'last_tile' => 'x'
            ];

            do
            {
                $nextStep = $this->processStep( $maze, $nextStep );


                $steps++;
            }
            while ( $nextStep[ 'next_tile' ] !== 'S' );

            return $steps / 2;
        }



        /**
         * @return array
         */
        private function getAnimalPosition(): array
        {
            $mazeSize = strpos( file_get_contents( INPUTS_PATH . '/2023/10_input.txt' ), "\r\n" );

            $maze = str_replace( "\r\n", '', file_get_contents( INPUTS_PATH . '/2023/10_input.txt' ) );

            $sPos = strpos( $maze, 'S' );
            $sX = $sPos % $mazeSize;
            $sY = (int)floor( $sPos / $mazeSize );

            return [ 'x' => $sX, 'y' => $sY ];
        }



        /**
         * @param array $maze
         * @param array $step
         * @return array
         */
        private function processStep( array $maze, array $step ): array
        {
            $x = $step[ 'x' ];
            $y = $step[ 'y' ];
            $lastMovement = $step[ 'last_movement' ];

            $tile = $maze[ $y ][ $x ];

            if ( $lastMovement == 'left_to_right' )
            {
                switch ( $tile )
                {
                    case "-":
                        $x += 1;
                        break;
                    case "J":
                        $y -= 1;
                        $lastMovement = 'down_to_up';
                        break;
                    case "7":
                        $y += 1;
                        $lastMovement = 'up_to_down';
                        break;
                    default:
                        echo "Error";
                        break;
                }

                return [ 'x' => $x, 'y' => $y, 'last_movement' => $lastMovement, 'next_tile' => $maze[ $y ][ $x ] ];
            }

            if ( $lastMovement == 'right_to_left' )
            {
                switch ( $tile )
                {
                    case "-":
                        $x -= 1;
                        break;
                    case "L":
                        $y -= 1;
                        $lastMovement = 'down_to_up';
                        break;
                    case "F":
                        $y += 1;
                        $lastMovement = 'up_to_down';
                        break;
                    default:
                        echo "Error";
                        break;
                }

                return [ 'x' => $x, 'y' => $y, 'last_movement' => $lastMovement, 'next_tile' => $maze[ $y ][ $x ] ];
            }

            if ( $lastMovement == 'up_to_down' )
            {
                switch ( $tile )
                {
                    case "|":
                        $y += 1;
                        break;
                    case "L":
                        $x += 1;
                        $lastMovement = 'left_to_right';
                        break;
                    case "J":
                        $x -= 1;
                        $lastMovement = 'right_to_left';
                        break;
                    default:
                        echo "Error";
                        break;
                }

                return [ 'x' => $x, 'y' => $y, 'last_movement' => $lastMovement, 'next_tile' => $maze[ $y ][ $x ] ];
            }

            if ( $lastMovement == 'down_to_up' )
            {
                switch ( $tile )
                {
                    case "|":
                        $y -= 1;
                        break;
                    case "7":
                        $x -= 1;
                        $lastMovement = 'right_to_left';
                        break;
                    case "F":
                        $x += 1;
                        $lastMovement = 'left_to_right';
                        break;
                    default:
                        echo "Error";
                        break;
                }

                return [ 'x' => $x, 'y' => $y, 'last_movement' => $lastMovement, 'next_tile' => $maze[ $y ][ $x ] ];
            }

            return $step;
        }



        /**
         * @return int
         */
        public function getPartTwoResult(): int
        {
            return 0;
        }



    }