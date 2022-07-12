<?php
    if(!function_exists("cli_color")){
        function cli_color($in_char_color = "default", $in_char_text){
            $colors = 
            [
                "default" => 39,
                "black" => 30,
                "red" => 31,
                "green" => 32,
                "yellow" => 33,
                "blue" => 34,
                "magenta" => 35,
                "cyan" => 36,
                "light gray" => 37,
                "dark gray" => 90,
                "light red" => 91,
                "light green" => 92,
                "light yellow" => 93,
                "light blue" => 94,
                "light magenta" => 95,
                "light cyan" => 96,
                "white" => 97,
            ];
            $color_code =39;
            isset($colors[$in_char_color]) && $color_code = $colors[$in_char_color];

            return "\e[{color_code}m{$in_char_text}\e[39m";
        }
    }