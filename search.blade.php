<!Doctype html>
<html lang="en-EG">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="none">
    <title>Sha3bola</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!--Applying an external stylesheet-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>
    <div class="menu">
        <div class="logo">
            <a href="/"><img src="images/sha3bola.png" id="Pic" alt="Sha3bola"></a>
        </div>

        <div id="formStyle">
            <form action="/search" name= "search" method="get">
                <div id="styleInput">
                    <input id="searchinput" placeholder="Search Sha3bola" name="searchinput" required type="text">
                </div>
            </form>
        </div>
    </div>

    <div class="linkPage">
        <div class="med" id="res" role="main">
            <div data-async-context="query:css" id = "ires">
                <div class="_NId">
                    <div class="g" data-hveid="35">
                            <div class = "container">
                                @foreach($visitedpages as $visitedpage)
                                    <div class="rc">
                                        <!--men awel hena!!-->

                                        <h3 class="r">
                                            @if($visitedpage->title != "")
                                            <a href={{ url( $visitedpage->Url) }}>{{ $visitedpage->title }}</a>
                                            @else
                                            <?php
                                                $newTitle = substr($visitedpage->Document,0,20);
                                            ?>
                                            <a href={{ url( $visitedpage->Url) }}>{{ $newTitle }}</a>
                                            @endif
                                            
                                        </h3>
                                        <div class="s">
                                            <div>
                                                <div class="f kv _SWb" style="white-space:nowrap">
                                                    <cite class="_Rm">{{ $visitedpage->Url }}</cite>
                                                </div>
                                                <?php
                                                    if($visitedpage->Document != "")
                                                    {
                                                        $documentReplace = explode("\r\n", $visitedpage->Document);
                                                        $documentReplace = str_replace("@"," ",$documentReplace);
                                                        $documentReplace = str_replace("#"," ",$documentReplace);
                                                        $documentReplace = str_replace('"'," ",$documentReplace);
                                                        $documentReplace = str_replace(","," ",$documentReplace);
                                                        $documentReplace = str_replace(";"," ",$documentReplace);
                                                        $documentReplace = str_replace("!"," ",$documentReplace);
                                                        $documentReplace = str_replace("?"," ",$documentReplace);
                                                        $documentReplace = str_replace("."," ",$documentReplace);
                                                        $documentReplace = str_replace("("," ",$documentReplace);
                                                        $documentReplace = str_replace(")"," ",$documentReplace);
                                                        $documentReplace = str_replace(":"," ",$documentReplace);
                                                        $documentReplace = str_replace("\\"," ",$documentReplace);
                                                        $documentReplace = str_replace("/"," ",$documentReplace);
                                                        $documentReplace = str_replace("["," ",$documentReplace);
                                                        $documentReplace = str_replace("]"," ",$documentReplace);
                                                        $documentReplace = str_replace("|"," ",$documentReplace);
                                                        $documentReplace = str_replace("*"," ",$documentReplace);
                                                        $documentReplace = str_replace(">"," ",$documentReplace);
                                                        $documentReplace = str_replace("{"," ",$documentReplace);
                                                        $documentReplace = str_replace("}"," ",$documentReplace);
                                                        $documentReplace = str_replace("+"," ",$documentReplace);
                                                        $documentReplace = str_replace("="," ",$documentReplace);

                                                        foreach($documentReplace as $documentReplaceWord)
                                                            $documentSplit = explode(" ", $documentReplaceWord);
                                                        }
                                                
                                                    //Search on one word
                                                    if(str_word_count($word) == 1 && $visitedpage->Document != "")
                                                    {
                                                        //get the position of the word
                                                        $positionsArray = explode(',', $visitedpage->Position);
                                                        if(sizeof($positionsArray) > 0)
                                                            $indexWord = $positionsArray[sizeof($positionsArray)/2];
                                                        else $indexWord = $positionsArray[0];
                                                        
                                                        //get the word entered by the user
                                                        $searchWord = " ".$documentSplit[$indexWord];
                                                       
                                                        //Bold the word and display the discription
                                                        $posWord = 0;
                                                        $posWord = strpos($visitedpage->Document, $searchWord." ");

                                                        
                                                        //if not found then the word is not surronded by spaces
                                                            //TO-DO
                                                        if($posWord == false)
                                                        {
                                                            $searchWord = $documentSplit[$indexWord];
                                                            $posWord = strpos($visitedpage->Document, $searchWord);
                                                        }
                                                        
                                                        //String after word
                                                        //determine length of discription displayed and string displayed 
                                                        $len = strlen($visitedpage->Document);
                                                        $stringAfterWord = substr ($visitedpage->Document, $posWord + strlen($searchWord) , $len);
                                                        $endOfDescription = strpos($stringAfterWord, '.');
                                                        
                                                        if($len >= 200 && $endOfDescription)
                                                            $len = $endOfDescription;
                                                        else $len = 200;
                                                        //if the length of the string after the word is too big
                                                        if($len >= 400)
                                                        {
                                                            $posFinal = strpos($stringAfterWord , ' ', 30);
                                                            if($posFinal == false)
                                                                $posFinal = strpos($stringAfterWord , ' ', 1);
                                                            $len = $posFinal;
                                                        } 
                                                        $stringDisplayedAfterWord = substr ($visitedpage->Document , $posWord + strlen($searchWord) , $len);
                                                        
                                                        
                                                        //String before the word
                                                        //get the beginning of the phrase
                                                        $lenBeforeWord = 0;
                                                        $pos = $posWord;
                                                        if($pos > 0)
                                                        {
                                                            $stringBeforeWord = substr ($visitedpage->Document , 0, $posWord);
                                                            //get the position of the beginning of the phrase
                                                            $pos = strrpos($stringBeforeWord , '.', -1);
                                                            if($pos == false)
                                                                $pos = strrpos($stringBeforeWord , ' ', -1);
                                                            else $pos = $pos + 1;
                                                            $lenBeforeWord = $posWord - $pos;
                                                            //if the string before the word bolded is too big
                                                            if($lenBeforeWord >= 200)
                                                            {
                                                                $pos = strrpos($stringBeforeWord , ' ', -40);
                                                                 $lenBeforeWord = $posWord - $pos;
                                                            }     
                                                        }
                                                        $stringDisplayedBeforeWord = substr ($visitedpage->Document , $pos, $lenBeforeWord);
                                                ?>
                                                
                                                <span class="st">{{ $stringDisplayedBeforeWord }}<b>{{$searchWord}}</b>{{$stringDisplayedAfterWord}}...</span>
                                                
                                                <?php
                                                    }
                                                    //More than one word
                                                    else if(str_word_count($word) > 1 && substr($word[0], 0) != '"' && substr($word[strlen($word)-1], 0) != '"'&& $visitedpage->Document != "")
                                                    {
                                                        //get the positions of words
                                                        $wordsArray = explode(' ', $word);
                                                        $i = 0;
                                                        $positionsArray = array();
                                                        $stringDisplayed = array();
                                                        foreach($Keywords as $Keyword)
                                                        {
                                                            if($Keyword->title == $visitedpage->title)
                                                            {
                                                                $positions = explode(',', $Keyword->Position);
                                                                if(sizeof($positions) > 0)
                                                                    $positionsArray[$i] = $positions[sizeof($positions)/2];
                                                                else $positionsArray[$i] = $positions[0];
                                                                $i++;
                                                            }
                                                        }
                                                        
                                                        sort($positionsArray);  //sort ascending
                                                        
                                                        $j = 0;
                                                        $lastPosition = 0;
                                                        $subString = $visitedpage->Document;
                                                        
                                                        for($i = 0; $i < sizeof($positionsArray); $i++)
                                                        {
                                                            //get the word entered by the user
                                                            $searchWord = " ".$documentSplit[$positionsArray[$i]];
                                                            
                                                            //Bold the word and display the discription
                                                            $posWord = 0;
                                                            $posWord = strpos($subString, $searchWord." ");
                                                            
                                                            //if not found then the word is not surronded by spaces
                                                                //TO-DO
                                                            if($posWord == false)
                                                            {
                                                                $searchWord = $documentSplit[$positionsArray[$i]];
                                                                $posWord = strpos($subString, $searchWord);
                                                            }
                                                           
                                                            
                                                            //if it is the first word then get the beginning of the string
                                                            if($i == 0)
                                                            {
                                                                //String before the word
                                                                //get the beginning of the phrase
                                                                $lenBeforeWord = 0;
                                                                $pos = $posWord;
                                                                if($pos > 0)
                                                                {
                                                                    $stringBeforeWord = substr ($visitedpage->Document , 0, $posWord);
                                                                    //get the position of the beginning of the phrase
                                                                    $pos = strrpos($stringBeforeWord , '.', -1);
                                                                    if($pos == false)
                                                                        $pos = strrpos($stringBeforeWord , ' ', -1);
                                                                    else $pos = $pos + 1;
                                                                    $lenBeforeWord = $posWord - $pos;
                                                                    //if the string before the word bolded is too big
                                                                    if($lenBeforeWord >= 200)
                                                                    {
                                                                        $pos = strrpos($stringBeforeWord , ' ', -40);
                                                                        $lenBeforeWord = $posWord - $pos;
                                                                    }
                                                                }
                                                                $stringDisplayed[$j] = substr($visitedpage->Document , $pos, $lenBeforeWord);
                                                                $j++;
                                                            }
                                                            
                                                            $stringDisplayed[$j] = $searchWord;
                                                            $j++;
                                                            
                                                            $lastPosition = $posWord + strlen($searchWord);
                                                            $subString = substr($subString, $lastPosition, strlen($visitedpage->Document)-$lastPosition);
                                                           
                                                            //String after word
                                                            //determine length of discription displayed and string displayed 
                                                            $len = strlen($subString);
                                                            if($i == (sizeof($positionsArray) - 1))
                                                            {
                                                                $stringAfterWord = substr($subString, 0 , $len);
                                                                $endOfDescription = strpos($stringAfterWord, '.');

                                                            }
                                                            else 
                                                            {
                                                                $endOfDescription = strpos($subString, " ".$documentSplit[$positionsArray[$i + 1]]." ");
                                                                if($endOfDescription == false)
                                                                    $endOfDescription = strpos($subString, $documentSplit[$positionsArray[$i + 1]]);
                                                            }
                                                           
                                                            
                                                            if($endOfDescription >= 200)
                                                            {
                                                                $len = strpos($subString , ' ', 1);
                                                                $stringDisplayed[$j] = substr ($subString , 0 , $len);
                                                                $j++;
                                                                break;
                                                            }
                                                            else $len = $endOfDescription;
                                                            
                                                            //if the length of the string after the word is too big
                                                            $stringDisplayed[$j] = substr ($subString , 0 , $len);
                                                            $j++;
                                                            $lastPosition = $lastPosition + $len;
                                                        }
                                                ?> 
                                                <span class="st">
                                                <?php
                                                    for($i = 0; $i < sizeof($stringDisplayed); $i++)
                                                    {
                                                        $string = $stringDisplayed[$i];
                                                        if(($i%2) != 0 || ($posWord == 0))
                                                        {
                                                ?>
                                                            <b>{{$string}}</b>
                                                <?php
                                                        }
                                                        else
                                                        {
                                                 ?>{{$string}}<?php }}?>...</span>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                        if($visitedpage->Document != "")
                                                        {
                                                            $stringDisplayedAfterWord = $stringDisplayedBeforeWord ="";
                                                            $phrase = substr($word, 1, strlen($word) - 2);
                                                            $posPhrase = strpos($visitedpage->Document, $phrase." ");
                                                            if($posPhrase == false)
                                                                $posPhrase = strpos($visitedpage->Document, $phrase);
                                                            if($posPhrase)
                                                            {
                                                                //String before the word
                                                                //get the beginning of the phrase
                                                                $lenBeforeWord = 0;
                                                                $pos = $posPhrase;
                                                                if($pos > 0)
                                                                {
                                                                    $stringBeforeWord = substr ($visitedpage->Document , 0, $posPhrase);
                                                                    //get the position of the beginning of the phrase
                                                                    $pos = strrpos($stringBeforeWord , '.', -1);
                                                                    if($pos == false)
                                                                        $pos = strrpos($stringBeforeWord , ' ', -1);
                                                                    else $pos = $pos + 1;
                                                                    $lenBeforeWord = $posPhrase - $pos;
                                                                    //if the string before the word bolded is too big
                                                                    if($lenBeforeWord >= 200)
                                                                    {
                                                                        $pos = strrpos($stringBeforeWord , ' ', -40);
                                                                         $lenBeforeWord = $posPhrase - $pos;
                                                                    }
                                                                }

                                                                $stringDisplayedBeforeWord = substr ($visitedpage->Document , $pos, $lenBeforeWord);

                                                                //String after word
                                                                //determine length of discription displayed and string displayed 
                                                                $len = strlen($visitedpage->Document);
                                                                $stringAfterWord = substr ($visitedpage->Document, $posPhrase + strlen($phrase) , $len);
                                                                $endOfDescription = strpos($stringAfterWord, '.');

                                                                if($len >= 200 && $endOfDescription)
                                                                    $len = $endOfDescription;
                                                                else $len = 200;
                                                                //if the length of the string after the word is too big
                                                                if($len >= 400)
                                                                {
                                                                    $posFinal = strpos($stringAfterWord , ' ', 30);
                                                                    if($posFinal == false)
                                                                        $posFinal = strpos($stringAfterWord , ' ', 1);
                                                                    $len = $posFinal;
                                                                } 
                                                                $stringDisplayedAfterWord = substr ($visitedpage->Document , $posPhrase + strlen($phrase) , $len);
                                                            }
                                                            

                                                    ?>
                                                    <span class="st">{{ $stringDisplayedBeforeWord }}<b>{{$phrase}}</b>{{$stringDisplayedAfterWord}}...</span>

                                                    <?php
                                                        }
                                                       
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div><br>
                                    @endforeach
                                {{ $visitedpages->appends(['searchinput' => $word ])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>