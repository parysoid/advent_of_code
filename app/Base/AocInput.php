<?php

    namespace App\Base;

    class AocInput
    {

        private const BASE_PATH = __DIR__ . '/../../inputs';

        /** @var string */
        private string $basePath;



        public function __construct()
        {
            $resolved = realpath( self::BASE_PATH );

            if ( $resolved === false )
            {
                throw new \RuntimeException( "AocInput: inputs folder not found: " . self::BASE_PATH );
            }

            $this->basePath = rtrim( $resolved, '/' );
        }



        /**
         * @param int $year
         * @param int $day
         * @param string $suffix
         * @return string
         */
        private function buildPath( int $year, int $day, string $suffix ): string
        {
            return sprintf( '%s/%d/%d_%s.txt', $this->basePath, $year, $day, $suffix );
        }



        /**
         * @param int $year
         * @param int $day
         * @param string $suffix
         * @return string
         */
        public function read( int $year, int $day, string $suffix = 'input' ): string
        {
            $path = $this->buildPath( $year, $day, $suffix );

            if ( !is_file( $path ) )
            {
                throw new \RuntimeException( "AoC input file not found: {$path}" );
            }

            return trim( file_get_contents( $path ) );
        }



        /**
         * @param int $year
         * @param int $day
         * @param string $suffix
         * @return array
         */
        public function readLines( int $year, int $day, string $suffix = 'input' ): array
        {
            $path = $this->buildPath( $year, $day, $suffix );

            if ( !is_file( $path ) )
            {
                throw new \RuntimeException( "AoC input file not found: {$path}" );
            }

            $lines = file( $path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
            return $lines === false ? [] : $lines;
        }



        /**
         * @param int $year
         * @param int $day
         * @param string $suffix
         * @return \Generator
         */
        public function iterateLines( int $year, int $day, string $suffix = 'input' ): \Generator
        {
            $path = $this->buildPath( $year, $day, $suffix );

            if ( !is_file( $path ) )
            {
                throw new \RuntimeException( "AoC input file not found: {$path}" );
            }

            $handle = fopen( $path, 'r' );
            if ( $handle === false )
            {
                throw new \RuntimeException( "Unable to open AoC input file: {$path}" );
            }

            try
            {
                while ( ( $line = fgets( $handle ) ) !== false )
                {
                    $line = rtrim( $line, "\r\n" );
                    if ( $line === '' )
                    {
                        continue;
                    }
                    yield $line;
                }
            }
            finally
            {
                fclose( $handle );
            }
        }


    }
