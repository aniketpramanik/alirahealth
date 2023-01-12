<?php
//Creation of a class dailyMotionApi
class dailyMotionApi{ 
    //Creation of a static method call_api
    public static function call_api(string $searchString,string $channelName){
    
        $options = [
                    "http" =>[
                    "method" => "GET",
                    "header" => "authorisation: Bearer {{token}}",// Bearer token authorization
                            ]
                    ];
    
        $context = stream_context_create($options);// using stream is to modify or enhance the behavior of a stream

        //Only allowing certain channels for the search which includes"music/news/lifestyle/videosgames/auto"

        if($channelName==="music"){
            $data = file_get_contents("https://api.dailymotion.com/".$searchString."?limit=15&channel=music", false,
            $context);// to read the contents of a file into a string
            
        }
        // restricting the search only for videos
        else if(($searchString!= "videos")){
            echo "Please Search for videos";
        }

        else if($channelName==="news"){
        $data = file_get_contents("https://api.dailymotion.com/".$searchString."?limit=15&channel=news", false,
            $context);// sending a GET request to the url of dailymotion based on requirements
         }

        else if($channelName==="lifestyle"){
        $data = file_get_contents("https://api.dailymotion.com/".$searchString."?limit=15&channel=lifestyle", false,
        $context);
        }

        else if($channelName==="videogames"){
        $data = file_get_contents("https://api.dailymotion.com/".$searchString."?limit=15&channel=videogames", false,
        $context);
        }

        else if($channelName==="auto"){
        $data = file_get_contents("https://api.dailymotion.com/".$searchString."?limit=15&channel=auto", false,
        $context);
        }

        else{
        echo "The Entered Channel is not allowed.";
        }
    return $data;// returning the response
    }   
}
   

//calling the static method and storing the returned result.
$result = dailyMotionApi::call_api("videos","music");

//Condition to check for valid response
if($result===NULL){
        echo "<br>No values returned.";
}else{
    
  $json_array = json_decode($result,true);//Storing the response 
 
// Showcasing  the response recieved from the api end point recursively.
  function display_array_recursive($json_rec){
        if($json_rec){
            foreach($json_rec as $key=> $value){
                if(is_array($value)){
                    display_array_recursive($value);
                }else{
                    echo $key.':&nbsp;'.$value.'<br><br>&nbsp&nbsp&nbsp';
                }
            }
        }
    }

    display_array_recursive($json_array);// calling the function recursively for the array of data response
      
}
   
    
    
?>
