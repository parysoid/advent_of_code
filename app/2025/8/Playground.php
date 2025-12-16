<?php

    use App\Base\AocInput;
    use Base\ITask;
    use Playground\Connections;
    use Playground\Distance;
    use Playground\Distances;

    class Playground extends AocInput implements ITask
    {

        /**
         * @return int
         */
        function getPartOneResult(): int
        {
            $lines = $this->readLines( 2025, 8 );
            $distances = new Distances();
            $boxesEntity = \Playground\Boxes::hydrateBoxes( $lines );
            $boxes = array_values( $boxesEntity->getBoxes() );
            $n = $boxesEntity->getBoxesCount();

            for ( $i = 0; $i < $n; $i++ )
            {
                for ( $j = $i + 1; $j < $n; $j++ )
                {
                    $boxA = $boxes[ $i ];
                    $boxB = $boxes[ $j ];

                    $dist2 = ( $boxB->getX() - $boxA->getX() ) ** 2
                        + ( $boxB->getY() - $boxA->getY() ) ** 2
                        + ( $boxB->getZ() - $boxA->getZ() ) ** 2;

                    $distances->attachDistance( new Distance( $boxA, $boxB, $dist2 ) );
                }
            }

            $distances->sortDistances();

            $limit = 1000;
            $c = 0;

            $connections = new Connections( $boxesEntity );
            $connections->initBoxes( $boxesEntity->getBoxes() );

            while ( $c < $limit )
            {
                $distance = $distances->getDistances()[ $c ];

                $connections->handleDistance( $distance );

                $c++;
            }

            return $connections->getResultTopProduct(  );
        }






        /**
         * @return int
         */
        function getPartTwoResult(): int
        {
            $lines = $this->readLines( 2025, 8 );
            $res = 0;

            return $res;
        }


    }