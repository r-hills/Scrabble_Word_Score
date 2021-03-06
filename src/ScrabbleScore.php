<?php
    class ScrabbleScore
    {
        function calculateScore($input)
        {
            $input = $this->stripPunctuation($input);
            if( $input == "") { return 0; }

            $input = strtoupper($input);
            $check_input = strtolower($input);
            $dictionary = file_get_contents("./../dictionary.txt");
            $dictionary_array = explode("\n", $dictionary);
            $return_array = array();

            if ( in_array($check_input, $dictionary_array) == true ) {

                $string_value_array =  [ "AEIOULNRST" => 1,
                                         "DG"         => 2,
                                         "BCMP"       => 3,
                                         "FHVWY"      => 4,
                                         "K"          => 5,
                                         "JX"         => 8,
                                         "QZ"         => 10
                                        ];


                array_push($return_array, $input);

                $char_array = str_split($input);
                $counter = 0;

                foreach($string_value_array as $key => $value) {
                    foreach ($char_array as $char) {
                        if ( (strpos($key, $char)) !==false ) {
                            $counter += $value;
                        }
                    }
                }

                array_push($return_array, $counter);

                return $return_array;
            } else {
                array_push($return_array,"Not a word!", 0);
                return $return_array;
            }
        }


        //=================================================================
        //  Function for stripping all punctuation and spaces from string
        //-----------------------------------------------------------------

        function stripPunctuation($str)
        {
            // Replaces any non-alpha characters with nothing ''.
            return preg_replace('/[^[:alpha:]]/', '', $str);

        }


    }
?>
