<?php
namespace Louve\Model;

class VanillaAPI {

    private $curl;

    private function appendAuth(){
        
        $timestamp = time();
        $email = 'api@lacagette-coop.fr';
        $query_string = '?query=value&email=' . VANILLA_API_USER_EMAIL . '&timestamp='.$timestamp;
        $request = ['query' => 'value',
                    'email' => $email,
                    'timestamp' => $timestamp
                   ];
        ksort($request,SORT_STRING);
        $request = implode('-', $request);
        $token = hash_hmac('sha256', strtolower($request), VANILLA_API_SECRET);
        $query_string .= '&token='.$token;
        return $query_string;
    }

    private function prepareCurl(){
        $this->curl = curl_init();
        $headers = array();
        $headers[] = 'Accept: application/json';
       
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1); 
    }

    public function getDiscussions(){
        $this->prepareCurl();
        $url = VANILLA_API_URL.'categories/17';
        $url.= $this->appendAuth();

        curl_setopt($this->curl, CURLOPT_URL, $url ); 
            
        $output = curl_exec($this->curl);
        if ($output !== false) {
            $output = json_decode($output);
            foreach ($output->Discussions as $disc) {
                var_dump($disc);
                echo "<hr />";
            }
            
        } else {
            
        }
    
      
        curl_close($this->curl);
    }
}