<?php

function convert($size)
{
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');

    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2).' '.$unit[$i];
}

$fi = new FilesystemIterator(__DIR__.'/htdocs/fantasygurunew.com/football/subscribers/articles', FilesystemIterator::SKIP_DOTS);
printf('There were %d Files<br><br>', iterator_count($fi));

$files_array = scandir(__DIR__.'/htdocs/fantasygurunew.com/football/subscribers/articles');

$inc = 0;
$tri = 0;
$double = 0;
$startmem = memory_get_usage();

//foreach ($files_array as $value)
for ($i = 400; $i < 450;++$i) {

     //$file = __DIR__."/htdocs/fantasygurunew.com/football/subscribers/articles/".$value;
     $file = __DIR__.'/htdocs/fantasygurunew.com/football/subscribers/articles/'.$files_array[$i];
    $searchfor = '<title>';

     // the following line prevents the browser from parsing this as HTML.
     //header('Content-Type: text/html');

     // get the file contents, assuming the file to be readable (and exist)
     $contents = file_get_contents($file);

    $delimiter = '#';
    $startTag = '<title>';
    $endTag = '</title>';
    $regex = $delimiter.preg_quote($startTag, $delimiter)
                         .'(.*?)'
                         .preg_quote($endTag, $delimiter)
                         .$delimiter
                         .'s';
    preg_match($regex, $contents, $matches);

    // If we get an array of 2, this means our explode was able to grab the html title tag in the document.
    // We are currently using the title as it has the date published element in it.
    if (count($matches  == 2))
    {

        echo "Filename is: ".$files_array[$i]."<br>The title is ".$matches[1]."<br>";

        // Check to see if the second element is set.
        /*
        if (isset($matches[1]))
        {


               // Counter for the total files processed
               ++$inc;

               // Remove the period
               $exp = explode('.', $files_array[$i]);
               //echo "File piece is ".$exp[0]."<br><br>";

               $expfirst = explode('-', $exp[0], 2);
               //print_r($expfirst);
               if ($expfirst) {
                   $month = $expfirst[0];

                    // If we got a hit, we can try a second time
                    // Check to see if this key exists
                    if (array_key_exists(1, $expfirst)) {
                        $expSecond = explode('-', $expfirst[1], 2);
                         //echo "We got a month ".$expfirst[0];
                         //print_r($expSecond);
                         if (isset($expSecond[1]))
                         {
                             // we got a date
                              //echo ", and we got a date ".$expSecond[1];

                              $expThird = explode('-', $expSecond[1], 1);
                             if ($expThird)
                             {
                                 //echo "Trifecta <br>";
                                   ++$tri;


                                         $delimiterContent = '#';
                                         $startTagContent = '<!--CM:Main:RichText-->';
                                         $endTagContent = '<!--CMEND:Main:RichText-->';
                                         $regexContent = $delimiterContent.preg_quote($startTagContent, $delimiterContent)
                                                               .'(.*?)'
                                                               .preg_quote($endTagContent, $delimiterContent)
                                                               .$delimiterContent
                                                               .'s';
                                         preg_match($regexContent, $contents, $matchesContents);


                                   //print_r($matchesContents[1]);
                                   $output = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $matchesContents[1]);
                                 //print_r($output);
                             }
                             else
                             {
                                // This means we only have a month and year.  Still usable.
                                //echo '<pre>';
                                //print_r($expSecond);
                                //echo '</pre>';
                             }
                         }
                         else
                         {
                             // This means we dont have second - present so therefore
                              // this might be only a month and year
                              // Need to check if the value is numerical
                              $stringOfText = str_split($expSecond[0]);
                             echo '<pre>';
                             print_r($stringOfText);
                             echo '</pre>';

                             if (is_numeric($stringOfText[0]))
                             {
                                 if (is_numeric($stringOfText[1]))
                                 {
                                     echo '<br>Month is '.$month.' WE HAVE A PAIR.  '.$stringOfText[0].$stringOfText[1].' Filename is '.$files_array[$i].'<br><br>';

                                 }
                                 else
                                 {
                                    echo '<br>We have a day('.$month.') and month('.$stringOfText[0].') pair<br><br>';
                                    ++$double;
                                 }
                             }
                             else
                             {
                                 echo '<br>Not an int so moving on<br><br>';
                             }
                         }
                    } else {
                        // That key doesnt exist
                    }
               }
        }
    */
    }


    echo date("F d Y H:i:s.",filemtime($file))."<br><br><br>";

    $delimiterContent = '#';
    $startTagContent = '<!--CM:Main:RichText-->';
    $endTagContent = '<!--CMEND:Main:RichText-->';
    $regexContent = $delimiterContent.preg_quote($startTagContent, $delimiterContent)
                                                               .'(.*?)'
                                                               .preg_quote($endTagContent, $delimiterContent)
                                                               .$delimiterContent
                                                               .'s';
    preg_match($regexContent, $contents, $matchesContents);


    //print_r($matchesContents[1]);
    $contentOfTheFile = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $matchesContents[1]);
    //print_r($output);

    $contents = '';
}
$endmem = memory_get_usage();
//echo '<br><br>Inc is '.$inc;
//echo '<br>Tri is '.$tri;
//echo '<br>Double is '.$double;
//$sum = $tri + $double;
//echo '<br>The sum is '.$sum;
//echo '<br>'.round($sum / $inc * 100, 2).' %';
echo '<br>Memory usage: '.memory_get_peak_usage();
echo '<br>Start mem is '.$startmem.' and the end mem is '.$endmem;
$diff = $endmem - $startmem;
echo '<br>Usage is '.convert($diff);






echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
